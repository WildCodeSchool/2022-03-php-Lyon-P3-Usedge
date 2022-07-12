<?php

namespace App\Controller;

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
        $planId = $researchPlanRepo->findOneBy(['researchRequest' => $id]);
        $researchPlanErrors = [];

        if (empty($dataComponent)) {
            $workshops = $workshopRepository->findAll();

            return $this->render('research_plan/research_plan.html.twig', [
                'workshops' => $workshops,
                'researchRequest' => $researchRequest,
            ]);
        }

        $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
        $researchPlanUtils->researchPlanCheckLength($dataComponent);
        $researchPlanErrors = $researchPlanUtils->getCheckErrors();

        if (!empty($planId)) {
            $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
            $researchPlanUtils->researchPlanCheckLength($dataComponent);
            $researchPlanErrors = $researchPlanUtils->getCheckErrors();
            if (empty($researchPlanErrors)) {
                $researchPlanUtils->addResearchPlanSection($dataComponent, $planId);
            }
        } elseif (empty($researchPlanErrors)) {
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
        ResearchPlanUtils $researchPlanUtils,
        ResearchPlanRepository $researchPlanRepo,
    ): Response {
        $planId = $researchPlanRepo->findOneBy(['researchRequest' => $id]);

        $dataComponent = $checkDataUtils->trimData($request);
        if (!empty($planId)) {
            if (!empty($dataComponent)) {
                $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
                $researchPlanUtils->researchPlanCheckLength($dataComponent);
                $researchPlanErrors = $researchPlanUtils->getCheckErrors();
                if (empty($researchPlanErrors)) {
                    $researchPlanUtils->addResearchPlanSection($dataComponent, $planId);
                }
            }
        } elseif (!empty($dataComponent)) {
            $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
            $researchPlanUtils->researchPlanCheckLength($dataComponent);
            $researchPlanErrors = $researchPlanUtils->getCheckErrors();
            if (empty($researchPlanErrors)) {
                $researchPlanUtils->addResearchPlan($dataComponent);
            }
        }
        $workshops = $workshopRepository->findAll();

        return $this->render('research_plan/research_plan.html.twig', [
            'workshops' => $workshops,
            'researchRequest' => $researchRequest,
        ]);
    }
}
