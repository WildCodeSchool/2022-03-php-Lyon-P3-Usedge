<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
    #[Route('/research/', name: 'research_index')]
    public function index(): Response
    {
        return $this->render('ResearchCenter/viewTemplate.html.twig', [

        ]);
    }
}
