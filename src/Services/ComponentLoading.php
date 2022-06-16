<?php

namespace App\Services;

use App\Entity\Section;
use App\Entity\ResearchTemplate;
use App\Entity\TemplateComponent;
use Doctrine\Persistence\ManagerRegistry;

class ComponentLoading
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

    public function loadSection(Section $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $section = new Section();

        $entityManager = $this->doctrine->getManager();

        $section->setName($dataComponent->getName());
        $section->setTitle($dataComponent->getTitle());
        $entityManager->persist($section);

        $templateComponent->setResearchTemplate($researchTemplate);
        $templateComponent->setComponent($section);
        $templateComponent->setNumberOrder(1);
        $entityManager->persist($templateComponent);

        $entityManager->flush();
    }
}
