<?php

namespace App\Service;

//use Doctrine\ORM\EntityManagerInterface;

class ResearchRequestUtils
{
    /* private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    } */

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
}
