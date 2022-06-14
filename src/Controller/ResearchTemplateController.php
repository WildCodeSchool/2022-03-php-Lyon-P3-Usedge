<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Component;
use App\Entity\ResearchTemplate;
use App\Entity\TemplateComponent;
use App\Form\AnswerType;
use App\Form\ComponentType;
use App\Form\ResearchTemplateType;
use App\Repository\AnswerRepository;
use App\Repository\ComponentRepository;
use App\Repository\ResearchTemplateRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/research-template', name: 'research_template_')]
class ResearchTemplateController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    public function index(Request $request, ResearchTemplateRepository $templateRepository): Response
    {
        $researchTemplate = new ResearchTemplate();
        $form = $this->createForm(ResearchTemplateType::class, $researchTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $templateRepository->add($researchTemplate, true);
            $id = $researchTemplate->getId();

            return $this->redirectToRoute('research_template_add', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_template/index.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(
        Request $request,
        ComponentRepository $componentRepository,
        AnswerRepository $answerRepository,
        ResearchTemplate $researchTemplate,
        ManagerRegistry $doctrine,
    ): Response {
        $answer = new Answer();
        $templateComponent = new TemplateComponent();
        $component = new Component();
        $form1 = $this->createForm(ComponentType::class, $component);
        $form1->handleRequest($request);
        $inputAnswerNumber = $request->get('input-answer-number');
        $answersValue = [];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            $answersValue [] = $request->get('answer' . $i);
        }

        if ($form1->isSubmitted() && $form1->isValid()) {
            $entityManager = $doctrine->getManager();
            $id = $researchTemplate->getId();
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($component);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);
            $componentRepository->add($component, true);
            $entityManager->flush();
            $i = 1;
            foreach ($answersValue as $answerValue) {
                $answer->setAnswer($answerValue);
                $answer->setQuestion($component);
                $answer->setNumberOrder($i++);
                $answerRepository->add($answer, true);
            }
            return $this->redirectToRoute('research_template_add', ['id' => $id], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('research_template/add.html.twig', [
            'form1' => $form1,
            'component' => $component,
            'researchTemplate' => $researchTemplate,
        ]);
    }
}
