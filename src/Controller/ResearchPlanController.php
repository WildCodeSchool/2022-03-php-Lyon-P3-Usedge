<?php

namespace App\Controller;

use App\Entity\ResearchRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchPlanController extends AbstractController
{
    #[Route('/research-plan/{id}', name: 'app_research_plan', methods: ['GET', 'POST'])]
    public function index(ResearchRequest $researchRequest): Response
    {
        return $this->render('research_plan/research_plan.html.twig', [
            'request' => $researchRequest,
        ]);
    }
}
