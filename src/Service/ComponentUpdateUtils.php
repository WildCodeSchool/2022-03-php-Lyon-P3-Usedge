<?php

namespace App\Service;

use App\Entity\ComponentEvaluationScale;
use App\Entity\DatePicker;
use App\Entity\ExternalLink;
use App\Entity\Section;
use App\Repository\ComponentEvaluationScaleRepository;
use App\Repository\DatePickerRepository;
use App\Repository\ExternalLinkRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUpdateUtils
{
    private ComponentEvaluationScaleRepository $evaluationScaleRepo;
    private DatePickerRepository $datePickerRepository;
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
        DatePickerRepository $datePickerRepository,
        ComponentEvaluationScaleRepository $evaluationScaleRepo,
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->sectionRepository = $sectionRepository;
        $this->externalLinkRepo = $externalLinkRepo;
        $this->datePickerRepository = $datePickerRepository;
        $this->evaluationScaleRepo = $evaluationScaleRepo;
    }

    public function loadUpdateSection(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $section = $this->sectionRepository->find($id);
        $this->checkErrors = $this->checkDataUtils->checkDataSection($dataComponent);

        if ($section instanceof Section && empty($this->checkErrors)) {
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

        if ($externalLink instanceof ExternalLink && empty($this->checkErrors)) {
            $externalLink->setName($dataComponent['name']);
            $externalLink->setTitle($dataComponent['title-external-link']);
            $externalLink->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->flush();
        }
    }

    public function loadUpdateDatePicker(array $dataComponent, int $id): void
    {
        $entityManager = $this->entityManager;
        $datePicker = $this->datePickerRepository->find($id);
        $this->checkErrors = $this->checkDataUtils->checkDataDatePicker($dataComponent);

        if (!isset($dataComponent['is_mandatory'])) {
            $dataComponent['is_mandatory'] = false;
        }

        if ($datePicker instanceof DatePicker && empty($this->checkErrors)) {
            $datePicker->setName($dataComponent['name']);
            $datePicker->setTitle($dataComponent['title-date-picker']);
            $datePicker->setIsMandatory($dataComponent['is_mandatory']);
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

        if ($evaluationScale instanceof ComponentEvaluationScale && empty($this->checkErrors)) {
            $evaluationScale->setName($dataComponent['name']);
            $evaluationScale->setQuestion($dataComponent['question-evaluation-scale']);
            $evaluationScale->setLowLabel($dataComponent['low-label']);
            $evaluationScale->setHighLabel($dataComponent['high-label']);
            $evaluationScale->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->flush();
        }
    }
}
