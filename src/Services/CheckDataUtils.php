<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

class CheckDataUtils
{
    private array $checkErrors = [];
    private array $answersValue = [];
    private array $dataComponent = [];

    public function trimData(Request $request): array
    {
        $dataComponent =  $request->request->all();
        foreach ($dataComponent as $key => $component) {
            if (is_string($component)) {
                $this->dataComponent += array($key => trim($component));
            }
            $this->dataComponent += array($key => $component);
        }
        return $this->dataComponent;
    }

    public function retrieveAnswers(array $dataComponent): array
    {
        $inputAnswerNumber = $dataComponent['input-answer-number'];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            $this->answersValue[] = $dataComponent['answer' . $i];
        }
        return $this->answersValue;
    }

    public function checkDataSingleChoice(array $dataComponent, array $answersValue): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }

        if (strlen($dataComponent['question']) > 255) {
            $this->checkErrors[] = 'Maximum length for question is 255 characters.';
        }

        foreach ($answersValue as $answerValue) {
            if (strlen($answerValue) > 255) {
                $this->checkErrors[] = 'Maximum length for high label is 255 characters.';
            }
        }
        return $this->checkErrors;
    }

    public function checkDataMultipleChoice(array $dataComponent, array $answersValue): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }

        if (strlen($dataComponent['question']) > 255) {
            $this->checkErrors[] = 'Maximum length for question is 255 characters.';
        }

        foreach ($answersValue as $answerValue) {
            if (strlen($answerValue) > 255) {
                $this->checkErrors[] = 'Maximum length for high label is 255 characters.';
            }
        }
        return $this->checkErrors;
    }

    public function checkDataEvaluationScale(array $dataComponent): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }

        if (strlen($dataComponent['low-label']) > 255) {
            $this->checkErrors[] = 'Maximum length for low label is 255 characters.';
        }

        if (strlen($dataComponent['high-label']) > 255) {
            $this->checkErrors[] = 'Maximum length for high label is 255 characters.';
        }
        return $this->checkErrors;
    }
}
