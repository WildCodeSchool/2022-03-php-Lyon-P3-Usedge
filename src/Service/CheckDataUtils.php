<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class CheckDataUtils
{
    private array $checkErrors = [];
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

    public function checkDataSingleAndMultipleChoice(array $dataComponent, array $answersValue): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }
        if (strlen($dataComponent['question']) > 255) {
            $this->checkErrors[] = 'Maximum length for question is 255 characters.';
        }
        if (empty($answersValue)) {
            $this->checkErrors[] = 'At least one choice is mandatory.';
        }
        foreach ($answersValue as $answerValue) {
            if (strlen($answerValue) > 255) {
                $this->checkErrors[] = 'Maximum length for Answer is 255 characters.';
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

    public function checkDataSection(array $dataComponent): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'This field is mandatory.';
            }
        }
        if (strlen($dataComponent['title']) > 255) {
            $this->checkErrors[] = 'Maximum length for title is 255 characters.';
        }
        return $this->checkErrors;
    }

    public function checkDataDatePicker(array $dataComponent): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }

        if (strlen($dataComponent['title-date-picker']) > 255) {
            $this->checkErrors[] = 'Maximum length for title is 255 characters.';
        }
        return $this->checkErrors;
    }

    public function checkDataExternalLink(array $dataComponent): array
    {
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'This field is mandatory.';
            }
        }
        if (strlen($dataComponent['title-external-link']) > 255) {
            $this->checkErrors[] = 'Maximum length for title is 255 characters.';
        }
        return $this->checkErrors;
    }

    public function checkDataOpenQuestion(array $dataComponent): array
    {
        if (strlen($dataComponent['open_question-question']) > 255) {
            $this->checkErrors[] = 'Maximum length for question is 255 characters.';
        }
        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'This field is mandatory.';
            }
        }
        if (strlen($dataComponent['open-question-answer']) > 255) {
            $this->checkErrors[] = 'Maximum length for Answer is 255 characters.';
        }
        return $this->checkErrors;
    }

    public function checkUpdateOpenQuestion(array $dataComponent): array
    {
        if (strlen($dataComponent['open_question-question']) > 255) {
            $this->checkErrors[] = 'Maximum length for question is 255 characters.';
        }
        if (empty($dataComponent['open_question-question'])) {
            $this->checkErrors[] = 'This field is mandatory.';
        }
        if (empty($dataComponent['open-question-answer'])) {
            $this->checkErrors[] = 'This field is mandatory.';
        }
        if (strlen($dataComponent['open-question-answer']) > 255) {
            $this->checkErrors[] = 'Maximum length for Answer is 255 characters.';
        }
        return $this->checkErrors;
    }
}
