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
                unset($dataComponent['request-component-id-' . $data]);
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
                        unset($dataComponent['answer-' . $componentId . '-' . $i]);
                    }
                }
                unset($dataComponent['request-component-name-' . $componentId]);
                unset($dataComponent['counter-answer-' . $componentId]);
                continue;
            }
            $answerList[] = [
                'request-component-name' => $dataComponent['request-component-name-' . $componentId],
                'answer' => $dataComponent['answer-' . $componentId]
            ];
            unset($dataComponent['request-component-name-' . $componentId]);
            unset($dataComponent['answer-' . $componentId]);
        }
        var_dump($answerList, $dataComponent);
        return $answerList;
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
