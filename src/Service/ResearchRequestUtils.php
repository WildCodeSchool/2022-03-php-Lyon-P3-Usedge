<?php

namespace App\Service;

use App\Entity\AnswerRequest;
use App\Entity\ResearchRequest;
use App\Repository\ResearchTemplateRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ResearchRequestUtils
{
    private EntityManagerInterface $entityManager;
    private ResearchTemplateRepository $resTempRepository;
    private array $checkErrors = [];

    public function __construct(
        EntityManagerInterface $entityManager,
        ResearchTemplateRepository $resTempRepository,
    ) {
        $this->entityManager = $entityManager;
        $this->resTempRepository = $resTempRepository;
    }

    public function researchRequestSortAnswer(array $dataComponent): array
    {
        $componentIdList = [];
        foreach ($dataComponent as $specification => $data) {
            if (str_contains($specification, 'request-component-id')) {
                $componentIdList[] = $data;
            }
        }

        $answerList = [];
        foreach ($componentIdList as $componentId) {
            if ($dataComponent['request-component-name-' . $componentId] === 'multiple-choice') {
                $multipleChoiceCount = $dataComponent['counter-answer-' . $componentId];
                for ($i = 0; $i < $multipleChoiceCount; $i++) {
                    if (isset($dataComponent['answer-' . $componentId . '-' . $i])) {
                        $answerList[] = [
                            'request-component-name' => $dataComponent['request-component-name-' . $componentId],
                            'answer' => $dataComponent['answer-' . $componentId . '-' . $i]
                        ];
                    }
                }
                continue;
            }
            $answerList[] = [
                'request-component-name' => $dataComponent['request-component-name-' . $componentId],
                'answer' => $dataComponent['answer-' . $componentId]
            ];
        }

        return $answerList;
    }

    public function researchRequestCheckErrors(array $answerList): array
    {
        foreach ($answerList as $answer) {
            switch ($answer['request-component-name']) {
                case 'date-picker':
                    if (!preg_match("/\d{4}\-\d{2}-\d{2}/", $answer['answer'])) {
                        $this->checkErrors[] = "This format of date is not available.";
                    }
                    break;
                case 'external-link':
                    if (!filter_var($answer['answer'], FILTER_VALIDATE_URL)) {
                        $this->checkErrors[] = "The URL is not valid.";
                    }
                    break;
            }
        }

        return $this->checkErrors;
    }

    public function addResearchRequest(array $dataComponent, array $answerList): void
    {
        $researchTemplate = $this->resTempRepository->findOneBy(['id' => $dataComponent['template_id']]);
        $entityManager = $this->entityManager;
        $researchRequest = new ResearchRequest();
        $creationDate = new DateTime("now");

        $researchRequest->setResearchTemplate($researchTemplate);
        $researchRequest->setCreationDate($creationDate);
        $researchRequest->setStatus($dataComponent['research-request-status']);
        $researchRequest->setProject($dataComponent['project']);
        $researchRequest->setOwner($dataComponent['owner']);
        $entityManager->persist($researchRequest);

        foreach ($answerList as $answers) {
            $requestAnswers = new AnswerRequest();
            $requestAnswers->setResearchRequest($researchRequest);
            $requestAnswers->setName($answers['request-component-name']);
            $requestAnswers->setAnswer($answers['answer']);
            $entityManager->persist($requestAnswers);
        }

        $entityManager->flush();
    }
}
