<?php

namespace App\Service;

use App\Repository\ExternalLinkRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;

class ComponentUpdateUtils
{
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
    ) {
        $this->entityManager = $entityManager;
        $this->checkDataUtils = $checkDataUtils;
        $this->sectionRepository = $sectionRepository;
        $this->externalLinkRepo = $externalLinkRepo;
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

        if (empty($this->checkErrors)) {
            $externalLink->setName($dataComponent['name']);
            $externalLink->setTitle($dataComponent['title-external-link']);
            $externalLink->setIsMandatory($dataComponent['is_mandatory']);
            $entityManager->flush();
        }
    }
}
