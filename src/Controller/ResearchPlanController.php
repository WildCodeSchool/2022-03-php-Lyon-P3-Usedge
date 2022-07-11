<?php

namespace App\Controller;

use App\Repository\CanvasWorkshopsRepository;
use App\Entity\ResearchRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchPlanController extends AbstractController
{
    #[Route('/research-plan/{id}', name: 'app_research_plan', methods: ['GET', 'POST'])]
    public function index(ResearchRequest $researchRequest, CanvasWorkshopsRepository $workshopRepository): Response
    {
        $workshops = $workshopRepository->findAll();

        return $this->render('research_plan/research_plan.html.twig', [
            'workshops' => $workshops,
            'researchRequest' => $researchRequest,
        ]);
    }

    #[Route('/research-plan/{id}/section', name: 'research_plan_new_section', methods: ['GET', 'POST'])]
    public function newSection(
        ResearchRequest $researchRequest,
        CanvasWorkshopsRepository $workshopRepository
    ): Response {
        $workshops = $workshopRepository->findAll();

        return $this->render('research_plan/research_plan.html.twig', [
            'workshops' => $workshops,
            'researchRequest' => $researchRequest,
        ]);
    }
}
