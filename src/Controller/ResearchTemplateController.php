<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\SingleChoice;
use App\Entity\ResearchTemplate;
use App\Entity\TemplateComponent;
use App\Form\ResearchTemplateType;
use App\Repository\AnswerRepository;
use App\Repository\SingleChoiceRepository;
use App\Repository\ResearchTemplateRepository;
use App\Repository\TemplateComponentRepository;
use App\Services\ComponentUtils;
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

    #[Route('/add/{id}', name: 'add', methods: ['GET', 'POST'])]
    public function add(
        Request $request,
        ResearchTemplate $researchTemplate,
        ComponentUtils $componentUtils,
        TemplateComponentRepository $tempCompRepository,
    ): Response {
        $componentName = $request->request->get('name');

        if ($componentName) {
            switch ($componentName) {
                case 'evaluation-scale':
                    $dataComponent =  $request->request->all();
                    foreach ($dataComponent as $component) {
                        if (is_string($component)) {
                            $component = trim($component);
                        }
                    }
                    $componentUtils->loadEvaluationScale($dataComponent, $researchTemplate);
                    break;
                case 'single-choice':
                    $componentUtils->loadSingleChoice($researchTemplate, $request);
                    break;
                default:
                    return new Response('Error 404 - This component is unknown.');
            }
        }

        $validationErrors = $componentUtils->getCheckErrors();
        $templateComponents = $tempCompRepository->findBy(['researchTemplate' => $researchTemplate->getId()]);

        return $this->render('research_template/add.html.twig', [
            'researchTemplate' => $researchTemplate,
            'errors' => $validationErrors,
            'templateComponents' => $templateComponents,
        ]);
    }
}
