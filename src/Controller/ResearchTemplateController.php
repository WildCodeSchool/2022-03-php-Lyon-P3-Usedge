<?php

namespace App\Controller;

use App\Entity\ResearchTemplate;
use App\Entity\Section;
use App\Entity\TemplateComponent;
use App\Form\ResearchTemplateType;
use App\Form\SectionType;
use App\Repository\ResearchTemplateRepository;
use App\Repository\SectionRepository;
use App\Repository\TemplateComponentRepository;
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

    #[Route('/add/{id}', name: 'add', methods: ['GET', 'POST'])]
    public function add(
        Request $request,
        SectionRepository $sectionRepository,
        ResearchTemplate $researchTemplate,
        ManagerRegistry $doctrine,
        TemplateComponentRepository $tempCompRepository,
    ): Response {
        $section = new Section();
        $templateComponent = new TemplateComponent();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $id = $researchTemplate->getId();
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($section);
            $orderNumber = 1;
            $templateComponent->setNumberOrder(++$orderNumber);

            $entityManager->persist($templateComponent);
            $sectionRepository->add($section, true);
            $entityManager->flush();

            return $this->redirectToRoute('research_template_add', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        $templateComponents = $tempCompRepository->findBy(['researchTemplate' => $researchTemplate->getId()]);

        return $this->renderForm('research_template/add.html.twig', [
            'form' => $form,
            'section' => $section,
            'researchTemplate' => $researchTemplate,
            'templateComponents' => $templateComponents,
        ]);
    }
}
