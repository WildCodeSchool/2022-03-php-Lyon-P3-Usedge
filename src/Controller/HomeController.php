<?php

namespace App\Controller;

use App\Entity\ResearchPlan;
use App\Repository\ResearchPlanRepository;
use App\Repository\ResearchRequestRepository;
use App\Repository\ResearchTemplateRepository;
use App\Service\CheckDataUtils;
use App\Service\ResearchPlanUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ResearchTemplateRepository $researchTemplates,
        ResearchRequestRepository $researchRequestRepo,
        ResearchPlanRepository $researchPlanRepo,
        Request $request,
        CheckDataUtils $checkDataUtils,
        ResearchPlanUtils $researchPlanUtils
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);
        if ($dataComponent) {
            $researchPlanUtils->researchPlanCheckEmpty($dataComponent);
            $researchPlanUtils->researchPlanCheckLength($dataComponent);
            $errors = $researchPlanUtils->getCheckErrors();
            if (empty($errors)) {
                $researchPlanUtils->addResearchPlan($dataComponent);
            }
        }
        $researchTemplateList = $researchTemplates->findBy(['status' => 'active']);
        $researchRequests = $researchRequestRepo->findBy([], ['id' => 'DESC']);
        $researchPlans = $researchPlanRepo->findBy([], ['id' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'researchTemplates' => $researchTemplateList,
            'researchRequests' => $researchRequests,
            'researchPlans' => $researchPlans,
        ]);
    }
}
