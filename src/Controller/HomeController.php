<?php

namespace App\Controller;

use App\Repository\ResearchRequestRepository;
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
        ResearchRequestRepository $researchRequestRepo,
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);
        $requestErrors = [];
        if (!empty($dataComponent)) {
            $answerList = $requestUtils->researchRequestSortAnswer($dataComponent);
            $requestUtils->researchRequestCheckDate($answerList);
            $requestUtils->researchRequestCheckURL($answerList);
            $requestErrors = $requestUtils->getCheckErrors();
            if (empty($requestErrors)) {
                $requestUtils->addResearchRequest($dataComponent, $answerList);
                return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
            }
        }

        $researchTemplateList = $researchTemplates->findBy(['status' => 'active']);
        $researchRequests = $researchRequestRepo->findBy([], ['id' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'researchTemplates' => $researchTemplateList,
            'researchRequests' => $researchRequests,
        ]);
    }
}
