<?php

namespace App\Controller;

use App\Repository\ResearchTemplateRepository;
use App\Service\CheckDataUtils;
use App\Service\ResearchRequestUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ResearchTemplateRepository $researchTemplates,
        CheckDataUtils $checkDataUtils,
        Request $request,
        ResearchRequestUtils $requestUtils,
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);

        if (!empty($dataComponent)) {
            $answerList = $requestUtils->researchRequestSortAnswer($dataComponent);
            var_dump($answerList);
            die();
        }
        $researchTemplateList = $researchTemplates->findBy(['status' => 'active']);

        return $this->render('home/index.html.twig', [
            'researchTemplates' => $researchTemplateList,
        ]);
    }
}
