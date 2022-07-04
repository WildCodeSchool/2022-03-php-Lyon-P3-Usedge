<?php

namespace App\Controller;

use App\Repository\ResearchTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ResearchTemplateRepository $researchTemplates): Response
    {
        $researchTemplateList = $researchTemplates->findBy(['status' => 'active']);

        return $this->render('home/index.html.twig', [
            'researchTemplates' => $researchTemplateList,
        ]);
    }
}
