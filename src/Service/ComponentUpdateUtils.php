<?php

namespace App\Service;

use App\Repository\AnswerRepository;
use App\Repository\ComponentEvaluationScaleRepository;
use App\Repository\DatePickerRepository;
use App\Repository\ExternalLinkRepository;
use App\Repository\MultipleChoiceRepository;
use App\Repository\SectionRepository;
use App\Repository\SingleChoiceRepository;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUpdateUtils
{
    private MultipleChoiceRepository $multipleChoiceRepo;
    private ComponentEvaluationScaleRepository $evaluationScaleRepo;
    private DatePickerRepository $datePickerRepository;
    private RetrieveAnswers $retrieveAnswers;
    private SingleChoiceRepository $singleChoiceRepo;
    private ExternalLinkRepository $externalLinkRepo;
    private SectionRepository $sectionRepository;
    private EntityManagerInterface $entityManager;
    private CheckDataUtils $checkDataUtils;
    private array $checkErrors = [];

    public function __construct(
        EntityManagerInterface $entityManager,
        CheckDataUtils $checkDataUtils,
        SectionRepository $sectionRepository,
        ExternalLinkRepository $externalLinkRepo,
        SingleChoiceRepository $singleChoiceRepo,
        RetrieveAnswers $retrieveAnswers,
        DatePickerRepository $datePickerRepository,
        ComponentEvaluationScaleRepository $evaluationScaleRepo,
        MultipleChoiceRepository $multipleChoiceRepo,
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->sectionRepository = $sectionRepository;
        $this->externalLinkRepo = $externalLinkRepo;
        $this->singleChoiceRepo = $singleChoiceRepo;
        $this->retrieveAnswers = $retrieveAnswers;
        $this->datePickerRepository = $datePickerRepository;
        $this->evaluationScaleRepo = $evaluationScaleRepo;
        $this->multipleChoiceRepo = $multipleChoiceRepo;
    }

    public function loadUpdateSection(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $section = $this->sectionRepository->find($id);
        $this->checkErrors = $this->checkDataUtils->checkDataSection($dataComponent);

        if (empty($this->checkErrors)) {
            $section->setTitle($dataComponent['title']);
            $entityManager->flush();
        }
    }

    public function loadUpdateExternalLink(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $externalLink = $this->externalLinkRepo->find($id);
        $this->checkErrors = $this->checkDataUtils->checkDataExternalLink($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $externalLink->setName($dataComponent['name']);
            $externalLink->setTitle($dataComponent['title-external-link']);
            $externalLink->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->flush();
        }
    }

    public function loadUpdateDatePicker(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $externalLink = $this->datePickerRepository->find($id);
        $this->checkErrors = $this->checkDataUtils->checkDataDatePicker($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $externalLink->setName($dataComponent['name']);
            $externalLink->setTitle($dataComponent['title-date-picker']);
            $externalLink->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->flush();
        }
    }

    public function loadUpdateEvaluationScale(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $evaluationScale = $this->evaluationScaleRepo->find($id);
        $this->checkErrors = $this->checkDataUtils->checkDataEvaluationScale($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $evaluationScale->setName($dataComponent['name']);
            $evaluationScale->setQuestion($dataComponent['question-evaluation-scale']);
            $evaluationScale->setLowLabel($dataComponent['low-label']);
            $evaluationScale->setHighLabel($dataComponent['high-label']);
            $evaluationScale->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->flush();
        }
    }

    public function loadUpdateSingleChoice(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $singleChoice = $this->singleChoiceRepo->find($id);
        $answersUpdateValue = $this->retrieveAnswers->retrieveUpdateAnswers($dataComponent);
        $this->checkErrors = $this->checkDataUtils
        ->checkDataSingleAndMultipleChoice($dataComponent, $answersUpdateValue);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $singleChoice->setName($dataComponent['name']);
            $singleChoice->setQuestion($dataComponent['question']);
            $singleChoice->setIsMandatory($dataComponent['is_mandatory']);

            foreach ($answersUpdateValue as $answerValue) {
                $answerValue->setAnswer($dataComponent['answer-update']);
            }

            //foreach ($answersUpdateValue as $answerValue) {
                    //$answer = $this->answerRepository->getId();
                    //$answerValue->setAnswer($dataComponent);
                    //$answer = new Answer();
                //$answer->setAnswer($dataComponent($answersUpdateValue));
                    //$answerValue->setQuestion($singleChoice);
                    //$answer->setNumberOrder(++$orderAnswer);
                    //$entityManager->persist($answer);
            //}
            $entityManager->flush();
        }
    }

    public function loadUpdateMultipleChoice(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $multipleChoice = $this->multipleChoiceRepo->find($id);
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
/*             foreach ($answersValue as $answerValue) {
                $answer = $this->answerRepository->getId();
                $answer->setAnswer($answerValue);
            } */
/*             $orderAnswer = 0;
            foreach ($answersValue as $answerValue) {
                    $answer = new Answer();
                    $answer->setAnswer($answerValue);
                    $answer->setQuestion($multipleChoice);
                    $answer->setNumberOrder(++$orderAnswer);
                    $entityManager->persist($answer);
            }
            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($multipleChoice);
            $templateComponent->setNumberOrder(count($researchTemplate->getTemplateComponents()) + 1);
            $entityManager->persist($templateComponent); */

            $entityManager->flush();
        }
    }
}
