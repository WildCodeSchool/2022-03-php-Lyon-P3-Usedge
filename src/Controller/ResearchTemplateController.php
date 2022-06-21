<?php

namespace App\Controller;

use App\Entity\ResearchTemplate;
use App\Form\ResearchTemplateType;
use App\Repository\ResearchTemplateRepository;
use App\Services\CheckDataUtils;
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
        CheckDataUtils $checkDataUtils,
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);

        if (in_array('single-choice', $dataComponent)) {
            $componentUtils->loadSingleChoice($researchTemplate, $dataComponent);
            $id = $researchTemplate->getId();
            return $this->redirectToRoute('research_template_add', [
                'id' => $id,
            ], Response::HTTP_SEE_OTHER);
        }
        if (in_array('evaluation-scale', $dataComponent)) {
            $componentUtils->loadEvaluationScale($dataComponent, $researchTemplate);
        }
        if (in_array('section', $dataComponent)) {
            $componentUtils->loadSection($dataComponent, $researchTemplate);
        }
        if (in_array('date-picker', $dataComponent)) {
            $componentUtils->loadDatapicker($dataComponent, $researchTemplate);
        }
        if (in_array('external-link', $dataComponent)) {
            $componentUtils->loadExternalLink($dataComponent, $researchTemplate);
        }

        $validationErrors = $componentUtils->getCheckErrors();

        return $this->render('research_template/add.html.twig', [
            'researchTemplate' => $researchTemplate,
            'errors' => $validationErrors
        ]);
    }
}
