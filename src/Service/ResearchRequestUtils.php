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

    public function newRequest(array $dataComponent): void
    {
        $componentIdList = [];
        foreach ($dataComponent as $key => $value) {
            if (str_contains($key, 'request-component-id')) {
                $componentIdList[] = $value;
            }
        }

        $finalArray = [];
        foreach ($componentIdList as $key => $value) {
            if ($dataComponent['request-component-name-' . $value] == 'multiple-choice') {
                $multipleChoiceCount = $dataComponent['counter-answer-' . $value];
                for ($i = 0; $i < $multipleChoiceCount; $i++) {
                    if (isset($dataComponent['answer-' . $value . '-' . $i])) {
                        $finalArray[] = [
                            'request-component-name' => $dataComponent['request-component-name-' . $value],
                            'answer' => $dataComponent['answer-' . $value . '-' . $i]
                        ];
                    }
                }
                continue;
            }
            $finalArray[] = [
                'request-component-name' => $dataComponent['request-component-name-' . $value],
                'answer' => $dataComponent['answer-' . $value]
            ];
        }
    }
}
