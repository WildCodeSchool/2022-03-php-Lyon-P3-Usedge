<?php

namespace App\Service;

use App\Entity\ResearchTemplate;

class ComponentUpdateManager
{
    private array $dataComponent;
    private ComponentUpdateUtils $compUpdatetUtils;
    private ResearchTemplate $researchTemplate;
    private int $componentId;
    private array $componentNames = [
        'section' => 'section',
    ];

    public function __construct(ComponentUpdateUtils $compUpdatetUtils)
    {
        $this->compUpdatetUtils = $compUpdatetUtils;
    }

    public function updateComponent(
        array $dataComponent,
        ResearchTemplate $researchTemplate,
        int $componentId
    ): int|null {
        $this->dataComponent = $dataComponent;
        $this->researchTemplate = $researchTemplate;
        $this->componentId = $componentId;
        $functionName = $this->componentNames[$this->dataComponent['name']];

        $id = $this->$functionName();
        return $id;
    }

    public function section(): int|null
    {
            $this->compUpdatetUtils->loadUpdateSection($this->dataComponent, $this->componentId);
            $id = $this->researchTemplate->getId();
            return $id;
    }
}
