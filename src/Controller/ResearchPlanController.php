<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchPlanController extends AbstractController
{
    #[Route('/research-plan', name: 'app_research_plan')]
    public function index(): Response
    {
        return $this->render('research_plan/research_plan.html.twig', [
            'controller_name' => 'ResearchPlanController',
        ]);
    }
}
