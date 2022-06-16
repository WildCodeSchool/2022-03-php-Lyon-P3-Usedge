<?php

namespace App\Services;

use App\Entity\Answer;
use App\Entity\ComponentEvaluationScale;
use App\Entity\ResearchTemplate;
use App\Entity\SingleChoice;
use App\Entity\TemplateComponent;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class ComponentUtils
{
    private ManagerRegistry $doctrine;
    private array $checkErrors = [];

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getCheckErrors(): array
    {
        return $this->checkErrors;
    }

    public function loadEvaluationScale(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $evalScaleComponent = new ComponentEvaluationScale();

        $dataAnswers = [];
        for ($loop = 1; $loop < 6; $loop++) {
            $dataAnswers[] = $dataComponent['evaluation-scale-rate-' . $loop];
        }

        foreach ($dataComponent as $data) {
            if (empty($data)) {
                $this->checkErrors[] = 'All fields are mandatory.';
            }
        }

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (strlen($dataComponent['low-label']) > 255) {
            $this->checkErrors[] = 'Maximum length for low label is 255 characters.';
        }

        if (strlen($dataComponent['high-label']) > 255) {
            $this->checkErrors[] = 'Maximum length for high label is 255 characters.';
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->doctrine->getManager();

            $evalScaleComponent->setName($dataComponent['name']);
            $evalScaleComponent->setQuestion($dataComponent['question']);
            $evalScaleComponent->setLowLabel($dataComponent['low-label']);
            $evalScaleComponent->setHighLabel($dataComponent['high-label']);
            $evalScaleComponent->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($evalScaleComponent);

            $orderAnswer = 0;
            foreach ($dataAnswers as $dataAnswer) {
                $answer = new Answer();
                $answer->setAnswer($dataAnswer);
                $answer->setQuestion($evalScaleComponent);
                $answer->setNumberOrder(++$orderAnswer);
                $entityManager->persist($answer);
            }

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($evalScaleComponent);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }

    public function loadSingleChoice(ResearchTemplate $researchTemplate, Request $request): void
    {
        $entityManager = $this->doctrine->getManager();
        $singleChoice = new SingleChoice();
        $templateComponent = new TemplateComponent();

        $question = $request->get('question');
        $isMandatory = $request->get('is_mandatory');
        $name = $request->get('singleName');
        if ($isMandatory != true) {
            $isMandatory = false;
        }
        $inputAnswerNumber = $request->get('input-answer-number');
        $answersValue = [];
        for ($i = 0; $i < $inputAnswerNumber; $i++) {
            $answersValue[] = $request->get('answer' . $i);
        }
        if (empty($this->checkErrors)) {
            $singleChoice->setQuestion($question);
            $singleChoice->setIsMandatory($isMandatory);
            $singleChoice->setName($name);
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($singleChoice);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);
            $entityManager->persist($singleChoice);

            $i = 1;
            foreach ($answersValue as $answerValue) {
                    $answer = new Answer();
                    $answer->setAnswer($answerValue);
                    $answer->setQuestion($singleChoice);
                    $answer->setNumberOrder($i++);
                    $entityManager->persist($answer);
            }
            $entityManager->flush();
        }
    }
}
