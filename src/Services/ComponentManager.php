<?php

namespace App\Services;

use App\Entity\ResearchTemplate;

class ComponentManager
{
    private array $dataComponent;
    private ComponentUtils $componentUtils;
    private ResearchTemplate $researchTemplate;
    private array $componentNames = [
        'single-choice' => 'singleChoice',
        'multiple-choice' => 'multipleChoice',
        'evaluation-scale' => 'evaluationScale',
        'section' => 'section',
        'separator' => 'separator',
        'date-picker' => 'datePicker',
        'external-link' => 'externalLink',
        'select' => 'select',
    ];

    public function __construct(ComponentUtils $componentUtils)
    {
        $this->componentUtils = $componentUtils;
    }

    public function initComponent(array $dataComponent, ResearchTemplate $researchTemplate): int
    {
        $this->dataComponent = $dataComponent;
        $this->researchTemplate = $researchTemplate;
        $functionName = $this->componentNames[$this->dataComponent['name']];

        $id = $this->$functionName();
        return $id;
    }

    public function singleChoice(): int
    {
            $this->componentUtils->loadSingleChoice($this->researchTemplate, $this->dataComponent);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function multipleChoice(): int
    {
            $this->componentUtils->loadMultipleChoice($this->researchTemplate, $this->dataComponent);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function evaluationScale(): int
    {
            $this->componentUtils->loadEvaluationScale($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function section(): int
    {
            $this->componentUtils->loadSection($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function separator(): int
    {
            $this->componentUtils->loadSeparator($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function datePicker(): int
    {
            $this->componentUtils->loadDatapicker($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function externalLink(): int
    {
            $this->componentUtils->loadExternalLink($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function select(): int
    {
            $this->componentUtils->loadSelector($this->researchTemplate, $this->dataComponent);
            $id = $this->researchTemplate->getId();
            return $id;
    }
}
