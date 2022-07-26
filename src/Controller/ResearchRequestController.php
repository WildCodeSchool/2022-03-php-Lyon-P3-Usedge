<?php

namespace App\Controller;

use App\Repository\ResearchRequestRepository;
use App\Repository\TemplateComponentRepository;
use App\Service\CheckDataUtils;
use App\Service\ResearchRequestMailer;
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
        ResearchRequestMailer $mailer,
        ResearchRequestRepository $resReqRepository,
    ): Response {
        $dataComponent = $checkDataUtils->trimData($request);
        $requestComponents = $tempCompRepository->findBy(['researchTemplate' => $id], ['numberOrder' => 'ASC']);
        $requestErrors = [];

        if (
            isset($dataComponent['project']) &&
            $this->isCsrfTokenValid(
                'add_research_request',
                $dataComponent['_token_add_research_request']
            )
        ) {
            $requestUtils->addResearchRequest($dataComponent);

            return $this->render('research_request/add.html.twig', [
                'requestComponents' => $requestComponents,
                'templateId' => $id,
            ]);
        }

        if (
            isset($dataComponent['research_request_template_id']) &&
            $this->isCsrfTokenValid(
                'add_research_request_answer',
                $dataComponent['_token_add_research_request_answer']
            )
        ) {
            $answerList = $requestUtils->researchRequestSortAnswer($dataComponent);
            $requestUtils->researchRequestCheckDate($answerList);
            $requestUtils->researchRequestCheckURL($answerList);
            $requestErrors = $requestUtils->getCheckErrors();
            if (empty($requestErrors)) {
                $requestStatus = $resReqRepository->findOneBy([], ['id' => 'DESC'])->getStatus();
                $requestUtils->addResearchRequestAnswer($answerList);
                if ($requestStatus === 'Waiting list') {
                    $mailer->researchRequestSendMail();
                } else {
                    return $this->redirectToRoute('app_home');
                }
            }
            return $this->render('research_request/confirm.html.twig', [
                'errors' => $requestErrors,
                'templateId' => $id,
            ]);
        }

        return $this->render('research_request/add.html.twig', [
            'requestComponents' => $requestComponents,
            'templateId' => $id,
        ]);
    }
}
