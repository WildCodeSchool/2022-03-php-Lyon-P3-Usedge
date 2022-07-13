<?php

namespace App\Controller;

use App\Entity\ResearchPlanSection;
use App\Repository\CanvasWorkshopsRepository;
use App\Entity\ResearchRequest;
use App\Repository\ResearchPlanRepository;
use App\Repository\ResearchPlanSectionRepository;
use App\Service\CheckDataUtils;
use App\Service\ResearchPlanUtils;
use App\Service\ResearchRequestMailer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchPlanController extends AbstractController
{
    #[Route('/research-plan/{id}', name: 'app_research_plan', methods: ['GET', 'POST'])]
    public function index(
        int $id,
        ResearchRequest $researchRequest,
        CanvasWorkshopsRepository $workshopRepository,
        Request $request,
        CheckDataUtils $checkDataUtils,
        ResearchPlanUtils $researchPlanUtils,
        ResearchRequestMailer $mailer,
        ResearchPlanRepository $researchPlanRepo,
    ): Response {

        $dataComponent = $checkDataUtils->trimData($request);
        $researchPlan = $researchPlanRepo->findOneBy(['researchRequest' => $id]);
        $researchPlanErrors = [];

        if (empty($dataComponent) & !empty($researchPlan)) {
            return $this->redirectToRoute('research_plan_new_section', ['id' => $id]);
        } elseif (empty($dataComponent)) {
            $workshops = $workshopRepository->findAll();

            return $this->render('research_plan/research_plan.html.twig', [
                'workshops' => $workshops,
                'researchRequest' => $researchRequest,
                'researchPlan' => $researchPlan,
            ]);
        }

        $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
        $researchPlanUtils->researchPlanCheckLength($dataComponent);
        $researchPlanErrors = $researchPlanUtils->getCheckErrors();
        if (empty($researchPlanErrors)) {
            $researchPlanUtils->addResearchPlan($dataComponent);
            $mailer->researchPlanSendMail();
        }

        return $this->render('research_plan/confirm.html.twig', ['errors' => $researchPlanErrors]);
    }

    #[Route('/research-plan/{id}/section', name: 'research_plan_new_section', methods: ['GET', 'POST'])]
    public function newSection(
        int $id,
        ResearchRequest $researchRequest,
        CanvasWorkshopsRepository $workshopRepository,
        Request $request,
        CheckDataUtils $checkDataUtils,
        ResearchPlanRepository $researchPlanRepo,
        ResearchPlanUtils $researchPlanUtils,
    ): Response {
        $researchPlan = $researchPlanRepo->findOneBy(['researchRequest' => $id]);
        $dataComponent = $checkDataUtils->trimData($request);

        if (empty($researchPlan) & empty(!$dataComponent)) {
            $researchPlanUtils->addResearchPlan($dataComponent);
            return $this->redirectToRoute('research_plan_new_section', ['id' => $id]);
        }

        $workshops = $workshopRepository->findAll();

        return $this->render('research_plan/research_plan.html.twig', [
            'workshops' => $workshops,
            'researchRequest' => $researchRequest,
            'researchPlan' => $researchPlan,
        ]);
    }

    #[Route('/research-plan/{researchRequestId}/section/{sectionId}
        ', name: 'research_plan_edit_section', methods: ['GET', 'POST'])]
    #[Entity('researchRequest', options: ['id' => 'researchRequestId'])]
    #[Entity('researchPlanSection', options: ['id' => 'sectionId'])]
    public function editSection(
        ResearchPlanSection $researchPlanSection,
        ResearchRequest $researchRequest,
        CanvasWorkshopsRepository $workshopRepository,
        Request $request,
        CheckDataUtils $checkDataUtils,
        ResearchPlanUtils $researchPlanUtils,
        ResearchPlanRepository $researchPlanRepo,
    ): Response {
        $resRequestId = $researchRequest->getId();
        $researchPlan = $researchPlanRepo->findOneBy(['researchRequest' => $resRequestId]);
        $dataComponent = $checkDataUtils->trimData($request);

        if (
            !empty($researchPlan) &
            $researchPlanSection instanceof ResearchPlanSection &
            !empty($dataComponent)
        ) {
            $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
            $researchPlanUtils->researchPlanCheckLength($dataComponent);
            $researchPlanErrors = $researchPlanUtils->getCheckErrors();
            if (empty($researchPlanErrors)) {
                $researchPlanUtils->updateResearchPlanSection($dataComponent, $researchPlan, $researchPlanSection);
            }
            return $this->redirectToRoute('research_plan_new_section', ['id' => $resRequestId]);
        } elseif (!empty($researchPlan) & !empty($dataComponent)) {
            $researchPlanUtils->addResearchPlanSection($dataComponent, $researchPlan);
        }

        $workshops = $workshopRepository->findAll();

        return $this->render('research_plan/research_plan_edit.html.twig', [
            'workshops' => $workshops,
            'researchRequest' => $researchRequest,
            'researchPlan' => $researchPlan,
            'researchPlanSection' => $researchPlanSection
        ]);
    }

    #[Route('/research-plan/{id}/validation', name: 'research_plan_validation', methods: ['GET', 'POST'])]
    public function researchPlanValidation(
        int $id,
        Request $request,
        CheckDataUtils $checkDataUtils,
        ResearchPlanUtils $researchPlanUtils,
        ResearchRequestMailer $mailer,
        ResearchPlanRepository $researchPlanRepo,
    ): Response {

        $dataComponent = $checkDataUtils->trimData($request);
        $researchPlan = $researchPlanRepo->findOneBy(['researchRequest' => $id]);

        if (
            !empty($dataComponent['research-plan-title']) ||
            !empty($dataComponent['workshop_description']) ||
            !empty($dataComponent['research-plan-recommendation'])
        ) {
            $researchPlanUtils->addResearchPlanSection($dataComponent, $researchPlan);
            $mailer->researchPlanSendMail();
        }
        $mailer->researchPlanSendMail();
        return $this->render('research_plan/confirm.html.twig');
    }
}
