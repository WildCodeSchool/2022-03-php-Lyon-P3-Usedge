<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\ResearchTemplate;
use App\Entity\Section;
use App\Entity\TemplateComponent;
use App\Form\ResearchTemplateType;
use App\Repository\ResearchTemplateRepository;
use App\Service\CheckDataUtils;
use App\Service\ComponentManager;
use App\Service\ComponentUpdateUtils;
use App\Service\ComponentUtils;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
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

    #[Route('/edit/{researchTemplateId}/{componentId}', name: 'edit_component')]
    #[Entity('researchTemplate', options: ['id' => 'researchTemplateId'])]
    #[Entity('component', options: ['id' => 'componentId'])]
    public function edit(
        Request $request,
        Component $component,
        ResearchTemplate $researchTemplate,
        CheckDataUtils $checkDataUtils,
        ComponentUpdateUtils $compUpdateUtils,
    ): Response {

        $dataComponent = $checkDataUtils->trimData($request);
        $componentId = $component->getId();
        $researchTemplateId = $researchTemplate->getId();

        if (!empty($dataComponent)) {
            $compUpdateUtils->loadUpdateSection($dataComponent, $componentId);
            return $this->redirectToRoute('research_template_add', [
                'id' => $researchTemplateId
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('research_template/edit.html.twig', [
            'researchTemplate' => $researchTemplate,
            'componentId' => $componentId,
            'researchTemplateId' => $researchTemplateId,
        ]);
    }
}
