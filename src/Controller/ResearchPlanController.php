<?php

namespace App\Controller;

use App\Repository\ResearchRequestRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchPlanController extends AbstractController
{
    #[Route('/research-plan/{id}', name: 'app_research_plan', methods: ['GET', 'POST'])]
    #[Entity('researchRequest', options: ['id' => 'researchRequestId'])]
    public function index(int $id, ResearchRequestRepository $researchRequestRepo): Response
    {
        $request = $researchRequestRepo->findBy(['id' => $id]);
        return $this->render('research_plan/research_plan.html.twig', [
            'request' => $request,
        ]);
    }
}
