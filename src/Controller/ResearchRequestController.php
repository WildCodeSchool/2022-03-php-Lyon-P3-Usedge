<?php

namespace App\Controller;

use App\Repository\TemplateComponentRepository;
use App\Service\CheckDataUtils;
use App\Service\ResearchRequestUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResearchRequestController extends AbstractController
{
    #[Route('/research-request/add/{id}', name: 'research_request_add', methods: ['GET', 'POST'])]
    public function index(
        int $id,
        TemplateComponentRepository $tempCompRepository,
        CheckDataUtils $checkDataUtils,
        Request $request,
        ResearchRequestUtils $requestUtils,
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);
        $requestErrors = [];

        if (isset($dataComponent['project'])) {
            $project = $dataComponent['project'];
            $templateId = $dataComponent['template_id'];
            $requestComponents = $tempCompRepository->findBy(['researchTemplate' => $id], ['numberOrder' => 'ASC']);

            return $this->render('research_request/add.html.twig', [
                'requestComponents' => $requestComponents,
                'project' => $project,
                'templateId' => $templateId,
            ]);
        }

        if ($dataComponent['request_project']) {
            $answerList = $requestUtils->researchRequestSortAnswer($dataComponent);
            $requestUtils->researchRequestCheckDate($answerList);
            $requestUtils->researchRequestCheckURL($answerList);
            $requestErrors = $requestUtils->getCheckErrors();
            if (empty($requestErrors)) {
                $requestUtils->addResearchRequest($dataComponent, $answerList);
            }
        }
        return $this->render('research_request/confirm.html.twig', ['errors' => $requestErrors]);
    }
}
