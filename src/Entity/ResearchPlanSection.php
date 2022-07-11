<?php

namespace App\Entity;

use App\Repository\ResearchPlanSectionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResearchPlanSectionRepository::class)]
class ResearchPlanSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private string $workshopName;

    #[ORM\Column(type: 'text')]
    private string $workshopDescription;

    #[ORM\Column(type: 'text')]
    private string $recommendation;

    #[ORM\Column(type: 'array', nullable: true)]
    private array $objectives = [];

    #[ORM\ManyToOne(targetEntity: ResearchPlan::class, inversedBy: 'researchPlanSections')]
    #[ORM\JoinColumn(nullable: false)]
    private ResearchPlan $researchPlan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getWorkshopName(): ?string
    {
        return $this->workshopName;
    }

    public function setWorkshopName(string $workshopName): self
    {
        $this->workshopName = $workshopName;

        return $this;
    }

    public function getWorkshopDescription(): ?string
    {
        return $this->workshopDescription;
    }

    public function setWorkshopDescription(string $workshopDescription): self
    {
        $this->workshopDescription = $workshopDescription;

        return $this;
    }

    public function getRecommendation(): ?string
    {
        return $this->recommendation;
    }

    public function setRecommendation(string $recommendation): self
    {
        $this->recommendation = $recommendation;

        return $this;
    }

    public function getObjectives(): ?array
    {
        return $this->objectives;
    }

    public function setObjectives(?array $objectives): self
    {
        $this->objectives = $objectives;

        return $this;
    }

    public function getResearchPlan(): ?ResearchPlan
    {
        return $this->researchPlan;
    }

    public function setResearchPlan(?ResearchPlan $researchPlan): self
    {
        $this->researchPlan = $researchPlan;

        return $this;
    }
}
