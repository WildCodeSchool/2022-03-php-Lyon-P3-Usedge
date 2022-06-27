<?php

namespace App\Services;

use App\Entity\Answer;
use App\Entity\ComponentEvaluationScale;
use App\Entity\OpenQuestion;
use App\Entity\DatePicker;
use App\Entity\ExternalLink;
use App\Entity\ResearchTemplate;
use App\Entity\Section;
use App\Entity\Separator;
use App\Entity\Selector;
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

    public function loadOpenQuestion(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $openQuestion = new OpenQuestion();
        $this->checkErrors = $this->checkDataUtils->checkDataOpenQuestion($dataComponent);
        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }
        if (!isset($dataComponent['addHelpertext'])) {
            $dataComponent['addHelpertext'] = false;
        }
        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;
            $openQuestion->setName($dataComponent['openQuestionName']);
            $openQuestion->setQuestion($dataComponent['open_question-question']);
            $openQuestion->setAddAHelpertext($dataComponent['addHelpertext']);
            $openQuestion->setHelperText($dataComponent['helperText']);
            $openQuestion->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->persist($openQuestion);

            $answer = new Answer();
            $answer->setAnswer($dataComponent['open-question-answer']);
            $answer->setQuestion($openQuestion);
            $answer->setNumberOrder(4);
            $entityManager->persist($answer);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($openQuestion);
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

            $separator->setName($dataComponent['separatorName']);
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

            $datepicker->setName($dataComponent['datePickerName']);
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

            $externalLink->setName($dataComponent['externalLinkName']);
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

    public function loadSelector(ResearchTemplate $researchTemplate, array $dataComponent): void
    {
        $selector = new Selector();
        $templateComponent = new TemplateComponent();
        $answersValue = $this->checkDataUtils->retrieveSelectAnswers($dataComponent);
        $this->checkErrors = $this->checkDataUtils->checkDataSelector($dataComponent, $answersValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->entityManager;

            $selector->setTitle($dataComponent['title']);
            $selector->setIsMandatory($dataComponent['is_mandatory']);
            $selector->setName($dataComponent['selectName']);
            $entityManager->persist($selector);

            $orderAnswer = 0;
            foreach ($answersValue as $answerValue) {
                    $answer = new Answer();
                    $answer->setAnswer($answerValue);
                    $answer->setQuestion($selector);
                    $answer->setNumberOrder(++$orderAnswer);
                    $entityManager->persist($answer);
            }
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($selector);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }
}
