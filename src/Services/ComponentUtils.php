<?php

namespace App\Services;

use App\Entity\Answer;
use App\Entity\ComponentEvaluationScale;
use App\Entity\MultipleChoice;
use App\Entity\ResearchTemplate;
use App\Entity\Section;
use App\Entity\SingleChoice;
use App\Entity\TemplateComponent;
use App\Services\CheckDataUtils;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUtils
{
    private EntityManagerInterface $entityManager;
    private CheckDataUtils $checkDataUtils;
    private array $checkErrors = [];

    public function __construct(EntityManagerInterface $entityManager, CheckDataUtils $checkDataUtils)
    {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
    }

    public function getCheckErrors(): array
    {
        return $this->checkErrors;
    }

    public function loadEvaluationScale(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $evalScaleComponent = new ComponentEvaluationScale();
        $this->checkErrors = $this->checkDataUtils->checkDataEvaluationScale($dataComponent);


        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $evalScaleComponent->setName($dataComponent['name']);
            $evalScaleComponent->setQuestion($dataComponent['question']);
            $evalScaleComponent->setLowLabel($dataComponent['low-label']);
            $evalScaleComponent->setHighLabel($dataComponent['high-label']);
            $evalScaleComponent->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($evalScaleComponent);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($evalScaleComponent);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }

    public function loadSingleChoice(ResearchTemplate $researchTemplate, array $dataComponent): void
    {
        $singleChoice = new SingleChoice();
        $templateComponent = new TemplateComponent();
        $answersValue = $this->checkDataUtils->retrieveAnswers($dataComponent);
        $this->checkErrors = $this->checkDataUtils->checkDataSingleChoice($dataComponent, $answersValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $singleChoice->setQuestion($dataComponent['question']);
            $singleChoice->setIsMandatory($dataComponent['is_mandatory']);
            $singleChoice->setName($dataComponent['singleName']);
            $entityManager->persist($singleChoice);

            $orderAnswer = 0;
            foreach ($answersValue as $answerValue) {
                    $answer = new Answer();
                    $answer->setAnswer($answerValue);
                    $answer->setQuestion($singleChoice);
                    $answer->setNumberOrder(++$orderAnswer);
                    $entityManager->persist($answer);
            }
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($singleChoice);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }

    public function loadSection(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $section = new Section();
        $this->checkErrors = $this->checkDataUtils->checkDataSection($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager =  $this->entityManager;

            $section->setName($dataComponent['sectionName']);
            $section->setTitle($dataComponent['title']);
            $section->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($section);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($section);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }
}
