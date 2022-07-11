<?php

namespace App\Controller;

use App\Repository\CanvasWorkshopsRepository;
use App\Entity\ResearchRequest;
use App\Service\CheckDataUtils;
use App\Service\ResearchPlanUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchPlanController extends AbstractController
{
    #[Route('/research-plan/{id}', name: 'app_research_plan', methods: ['GET', 'POST'])]
    public function index(
        ResearchRequest $researchRequest,
        CanvasWorkshopsRepository $workshopRepository,
        Request $request,
        CheckDataUtils $checkDataUtils,
        ResearchPlanUtils $researchPlanUtils
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);
        //var_dump($dataComponent); die();
        if ($dataComponent) {
            $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
            $researchPlanUtils->researchPlanCheckLength($dataComponent);
            $errors = $researchPlanUtils->getCheckErrors();
            if (empty($errors)) {
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
