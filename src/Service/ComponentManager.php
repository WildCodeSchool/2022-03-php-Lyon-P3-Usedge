<?php

namespace App\Service;

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
        'open-question' => 'openQuestion',
    ];

    public function __construct(ComponentUtils $componentUtils)
    {
        $this->componentUtils = $componentUtils;
    }

    public function initComponent(array $dataComponent, ResearchTemplate $researchTemplate): int|null
    {
        $this->dataComponent = $dataComponent;
        $this->researchTemplate = $researchTemplate;
        $functionName = $this->componentNames[$this->dataComponent['name']];

        $id = $this->$functionName();
        return $id;
    }

    public function singleChoice(): int|null
    {
            $this->componentUtils->loadSingleChoice($this->researchTemplate, $this->dataComponent);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function multipleChoice(): int|null
    {
            $this->componentUtils->loadMultipleChoice($this->researchTemplate, $this->dataComponent);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function evaluationScale(): int|null
    {
            $this->componentUtils->loadEvaluationScale($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function section(): int|null
    {
            $this->componentUtils->loadSection($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function separator(): int|null
    {
            $this->componentUtils->loadSeparator($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function datePicker(): int|null
    {
            $this->componentUtils->loadDatapicker($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function externalLink(): int|null
    {
            $this->componentUtils->loadExternalLink($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }

    public function openQuestion(): int|null
    {
            $this->componentUtils->loadOpenQuestion($this->dataComponent, $this->researchTemplate);
            $id = $this->researchTemplate->getId();
            return $id;
    }
}
