<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\ResearchTemplate;
use App\Form\ResearchTemplateType;
use App\Repository\ComponentRepository;
use App\Repository\ResearchTemplateRepository;
use App\Services\CheckDataUtils;
use App\Services\ComponentManager;
use App\Services\ComponentUtils;
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

    #[Route('/{researchTemplateId}/{componentId}', name: 'component_delete', methods: ['POST'])]
    #[Entity('researchTemplate', options: ['id' => 'researchTemplateId'])]
    #[Entity('component', options: ['id' => 'componentId'])]
    public function delete(
        Request $request,
        Component $component,
        ComponentRepository $componentRepository,
        ResearchTemplate $researchTemplate,
    ): Response {

        if (
            $this->isCsrfTokenValid('delete' . $component->getId(), $request
            ->request->get('_token' . $component->getId()))
        ) {
            $componentRepository->remove($component, true);
        }
        $id = $researchTemplate->getId();

        return $this->redirectToRoute('research_template_add', ['id' => $id], Response::HTTP_SEE_OTHER);
    }
}
