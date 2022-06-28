<?php

namespace App\Controller;

use App\Entity\ResearchTemplate;
use App\Form\ResearchTemplateType;
use App\Repository\ResearchTemplateRepository;
use App\Repository\TemplateComponentRepository;
use App\Service\CheckDataUtils;
use App\Service\ComponentManager;
use App\Service\ComponentUtils;
use App\Service\RetrieveAnswers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/research-template', name: 'research_template_')]
class ResearchTemplateController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    public function index(
        Request $request,
        ResearchTemplateRepository $templateRepository,
        TemplateComponentRepository $tempCompRepository,
        CheckDataUtils $checkDataUtils,
        RetrieveAnswers $retrieveAnswers
    ): Response {
        $researchTemplateList = $templateRepository->findBy([], ['id' => 'DESC']);
        $dataComponent =  $checkDataUtils->trimData($request);

        if (isset($dataComponent['research-template-status'])) {
            $templateRepository->updateTemplateStatus($dataComponent);
        }

        if (isset($dataComponent['components-number-count'])) {
            $orderNumber = $retrieveAnswers->retrieveOrderComponents($dataComponent);
            $tempCompRepository->updateNumberOrder($orderNumber);
        }

        $researchTemplate = new ResearchTemplate();
        $form = $this->createForm(ResearchTemplateType::class, $researchTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $templateRepository->add($researchTemplate, true);
            $id = $researchTemplate->getId();
            return $this->redirectToRoute('research_template_add', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_template/index.html.twig', [
            'form' => $form,
            'researchTemplates' => $researchTemplateList,
        ]);
    }

    #[Route('/add/{id}', name: 'add', methods: ['GET', 'POST'])]
    public function add(
        Request $request,
        ResearchTemplate $researchTemplate,
        ComponentUtils $componentUtils,
        CheckDataUtils $checkDataUtils,
        ComponentManager $componentManager
    ): Response {

        $dataComponent = $checkDataUtils->trimData($request);

        if (!empty($dataComponent)) {
            $id = $componentManager->initComponent($dataComponent, $researchTemplate);
            return $this->redirectToRoute('research_template_add', [
                'id' => $id,
            ], Response::HTTP_SEE_OTHER);
        }

        $validationErrors = $componentUtils->getCheckErrors();

        return $this->render('research_template/add.html.twig', [
            'researchTemplate' => $researchTemplate,
            'errors' => $validationErrors
        ]);
    }
}
