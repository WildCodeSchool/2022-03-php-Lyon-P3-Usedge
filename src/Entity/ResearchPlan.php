<?php

namespace App\Entity;

use App\Repository\ResearchPlanRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResearchPlanRepository::class)]
class ResearchPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $coach;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'date')]
    private DateTimeInterface $creationDate;

    #[ORM\OneToOne(inversedBy: 'researchPlan', targetEntity: ResearchRequest::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ResearchRequest $researchRequest;

    #[ORM\OneToMany(mappedBy: 'researchPlan', targetEntity: ResearchPlanSection::class)]
    private Collection $researchPlanSections;

    public function __construct()
    {
        $this->researchPlanSections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(string $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getResearchRequest(): ?ResearchRequest
    {
        return $this->researchRequest;
    }

    public function setResearchRequest(ResearchRequest $researchRequest): self
    {
        $this->researchRequest = $researchRequest;

        return $this;
    }

    /**
     * @return Collection<int, ResearchPlanSection>
     */
    public function getResearchPlanSections(): Collection
    {
        return $this->researchPlanSections;
    }

    public function addResearchPlanSection(ResearchPlanSection $researchPlanSection): self
    {
        if (!$this->researchPlanSections->contains($researchPlanSection)) {
            $this->researchPlanSections[] = $researchPlanSection;
            $researchPlanSection->setResearchPlan($this);
        }

        return $this;
    }

    public function removeResearchPlanSection(ResearchPlanSection $researchPlanSection): self
    {
        $this->researchPlanSections->removeElement($researchPlanSection);

        return $this;
    }
}
