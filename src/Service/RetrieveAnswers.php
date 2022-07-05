<?php

namespace App\Service;

class RetrieveAnswers
{
    private array $answersValue = [];
    private array $answersUpdateValue = [];

    public function retrieveAnswers(array $dataComponent): array
    {
        $inputAnswerNumber = $dataComponent['input-answer-number'];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            if (isset($dataComponent['answer' . $i])) {
                $this->answersValue[] = $dataComponent['answer' . $i];
            }
        }
        return $this->answersValue;
    }

    public function retrieveAnswersMultiple(array $dataComponent): array
    {
        $inputAnswerNumber = $dataComponent['input-answer-number-multiple'];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            $this->answersValue[] = $dataComponent['answer' . $i];
        }

        return $this->answersValue;
    }

    public function retrieveSelectAnswers(array $dataComponent): array
    {
        $inputAnswerNumber = $dataComponent['select-answer-number'];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            if (isset($dataComponent['select_answer' . $i])) {
                $this->answersValue[] = $dataComponent['select_answer' . $i];
            }
        }

        return $this->answersValue;
    }

    public function retrieveOrderComponents(array $dataComponent): array
    {
        if (isset($dataComponent['components-number-count'])) {
            $numberOfComponents = $dataComponent['components-number-count'];
            for ($i = 1; $i <= $numberOfComponents; $i++) {
                $this->answersValue[] = [
                    'numberOrder' => $dataComponent['component-order-number' . $i],
                    'componentId' => $dataComponent['research-template-component-id' . $i]
                ];
            }
        }
        return $this->answersValue;
    }

    public function retrieveUpdateAnswers(array $dataComponent): array
    {
        $inputAnswerNumber  = $dataComponent['answer-update'];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            if (isset($dataComponent['answer-update-' . $i])) {
                $this->answersUpdateValue[] = $dataComponent['answer-update' . $i];
            }
        }
        return $this->answersUpdateValue;
    }
}
