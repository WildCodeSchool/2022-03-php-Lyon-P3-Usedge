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
    ): Response {
        $workshops = $workshopRepository->findAll();

        return $this->render('research_plan/research_plan.html.twig', [
            'workshops' => $workshops,
            'researchRequest' => $researchRequest,
        ]);
    }
}
