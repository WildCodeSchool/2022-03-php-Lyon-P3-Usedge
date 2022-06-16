<?php

namespace App\Controller;

use App\Entity\ResearchTemplate;
use App\Entity\Section;
use App\Form\ResearchTemplateType;
use App\Form\SectionType;
use App\Repository\ResearchTemplateRepository;
use App\Repository\TemplateComponentRepository;
use App\Services\ComponentLoading;
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
        ComponentLoading $componentLoading,
        TemplateComponentRepository $tempCompRepository,
    ): Response {

        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);
        $componantName = $request->request->get('name');

        $dataComponent = $form->getData();
        $componantName = $dataComponent->getName();

        if ($componantName) {
            switch ($componantName) {
                case 'section':
                    if ($form->isSubmitted() && $form->isValid()) {
                        $componentLoading->loadSection($dataComponent, $researchTemplate);
                    }
                    break;
            }
        }

        $validationErrors = $componentLoading->getCheckErrors();
        $templateComponents = $tempCompRepository->findBy(['researchTemplate' => $researchTemplate->getId()]);

        return $this->renderForm('research_template/add.html.twig', [
            'researchTemplate' => $researchTemplate,
            'errors' => $validationErrors,
            'templateComponents' => $templateComponents,
            'form' => $form,
        ]);
    }
}
