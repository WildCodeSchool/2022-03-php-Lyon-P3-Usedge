<?php

namespace App\Service;

use App\Entity\Answer;
use App\Entity\ComponentEvaluationScale;
use App\Entity\MultipleChoice;
use App\Entity\DatePicker;
use App\Entity\ExternalLink;
use App\Entity\ResearchTemplate;
use App\Entity\Section;
use App\Entity\Separator;
use App\Entity\SingleChoice;
use App\Entity\TemplateComponent;
use App\Service\CheckDataUtils;
use App\Service\RetrieveAnswers;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUtils
{
    private EntityManagerInterface $entityManager;
    private CheckDataUtils $checkDataUtils;
    private RetrieveAnswers $retrieveAnswers;
    private array $checkErrors = [];

    public function __construct(
        EntityManagerInterface $entityManager,
        CheckDataUtils $checkDataUtils,
        RetrieveAnswers $retrieveAnswers
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->retrieveAnswers = $retrieveAnswers;
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
        $answersValue = $this->retrieveAnswers->retrieveAnswers($dataComponent);
        $this->checkErrors = $this->checkDataUtils->checkDataSingleAndMultipleChoice($dataComponent, $answersValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $singleChoice->setQuestion($dataComponent['question']);
            $singleChoice->setIsMandatory($dataComponent['is_mandatory']);
            $singleChoice->setName($dataComponent['name']);
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

    public function loadMultipleChoice(ResearchTemplate $researchTemplate, array $dataComponent): void
    {
        $multipleChoice = new MultipleChoice();
        $templateComponent = new TemplateComponent();
        $answersValue = $this->retrieveAnswers->retrieveAnswersMultiple($dataComponent);
        $this->checkErrors = $this->checkDataUtils->checkDataSingleAndMultipleChoice($dataComponent, $answersValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $multipleChoice->setQuestion($dataComponent['question']);
            $multipleChoice->setIsMandatory($dataComponent['is_mandatory']);
            $multipleChoice->setName($dataComponent['name']);
            $entityManager->persist($multipleChoice);

            $orderAnswer = 0;
            foreach ($answersValue as $answerValue) {
                    $answer = new Answer();
                    $answer->setAnswer($answerValue);
                    $answer->setQuestion($multipleChoice);
                    $answer->setNumberOrder(++$orderAnswer);
                    $entityManager->persist($answer);
            }
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($multipleChoice);
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

            $section->setName($dataComponent['name']);
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

    public function loadSeparator(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $separator = new Separator();

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager =  $this->entityManager;

            $separator->setName($dataComponent['name']);
            $separator->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($separator);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($separator);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }
    public function loadDatapicker(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $datepicker = new DatePicker();
        $this->checkErrors = $this->checkDataUtils->checkDataDatePicker($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager =  $this->entityManager;

            $datepicker->setName($dataComponent['name']);
            $datepicker->setTitle($dataComponent['title-date-picker']);
            $datepicker->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($datepicker);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($datepicker);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }

    public function loadExternalLink(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $externalLink = new ExternalLink();
        $this->checkErrors = $this->checkDataUtils->checkDataExternalLink($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $externalLink->setName($dataComponent['name']);
            $externalLink->setTitle($dataComponent['title-external-link']);
            $externalLink->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($externalLink);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($externalLink);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }
}
