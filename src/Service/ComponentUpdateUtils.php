<?php

namespace App\Service;

use App\Repository\DatePickerRepository;
use App\Repository\ExternalLinkRepository;
use App\Repository\SectionRepository;
use App\Repository\SingleChoiceRepository;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUpdateUtils
{
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
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->sectionRepository = $sectionRepository;
        $this->externalLinkRepo = $externalLinkRepo;
        $this->singleChoiceRepo = $singleChoiceRepo;
        $this->retrieveAnswers = $retrieveAnswers;
        $this->datePickerRepository = $datePickerRepository;
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

    public function loadUpdateSingleChoice(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $singleChoice = $this->singleChoiceRepo->find($id);
        $answersUpdateValues = $this->retrieveAnswers->retrieveUpdateAnswers($dataComponent);
        $this->checkErrors =
        $this->checkDataUtils->checkDataSingleAndMultipleChoice($dataComponent, $answersUpdateValues);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if (empty($this->checkErrors)) {
            $singleChoice->setName($dataComponent['name']);
            $singleChoice->setQuestion($dataComponent['question']);
            $singleChoice->setIsMandatory($dataComponent['is_mandatory']);

            foreach ($answersUpdateValues as $answersUpdateValue) {
                    //$answerValue = $this->answerRepository->getId();
                    //$answerValue->setAnswer($dataComponent);
                    //$answer = new Answer();
                    $answersUpdateValue->setAnswer($dataComponent['input-answer-update']);
                    //$answerValue->setQuestion($singleChoice);
                    //$answer->setNumberOrder(++$orderAnswer);
                    //$entityManager->persist($answer);
            }
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
}
