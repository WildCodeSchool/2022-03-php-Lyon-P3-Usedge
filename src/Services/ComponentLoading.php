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

    public function loadSection(array $dataComponent, ResearchTemplate $researchTemplate): void
    {
        $templateComponent = new TemplateComponent();
        $section = new Section();

        if (strlen($dataComponent['title']) > 255) {
            $this->checkErrors[] = 'Maximum length for title is 255 characters.';
        }

        if (empty($this->checkErrors)) {
            $entityManager = $this->doctrine->getManager();

            $section->setName($dataComponent['name']);
            $section->setTitle($dataComponent['title']);
            $entityManager->persist($section);

            $templateComponent->setResearchTemplate($researchTemplate);
            $templateComponent->setComponent($section);
            $templateComponent->setNumberOrder(1);
            $entityManager->persist($templateComponent);

            $entityManager->flush();
        }
    }
}
