<?php

namespace App\Entity;

use App\Repository\ResearchTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ResearchTemplateRepository::class)]
class ResearchTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    private string $name;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    private string $description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    private string $coach;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    #[Assert\NotNull(message: 'You have to choose an icon.')]
    private string $icon;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    private ?string $status;

    #[ORM\OneToMany(mappedBy: 'researchTemplate', targetEntity: TemplateComponent::class)]
    private Collection $templateComponents;

    #[ORM\OneToMany(mappedBy: 'researchTemplate', targetEntity: ResearchRequest::class, orphanRemoval: true)]
    private Collection $researchRequests;

    public function __construct()
    {
        $this->templateComponents = new ArrayCollection();
        $this->researchRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

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

    /**
     * @return Collection<int, TemplateComponent>
     */
    public function getTemplateComponents(): Collection
    {
        return $this->templateComponents;
    }

    public function addTemplateComponent(TemplateComponent $templateComponent): self
    {
        if (!$this->templateComponents->contains($templateComponent)) {
            $this->templateComponents[] = $templateComponent;
            $templateComponent->setResearchTemplate($this);
        }

        return $this;
    }

    public function removeTemplateComponent(TemplateComponent $templateComponent): self
    {
        $this->templateComponents->removeElement($templateComponent);

        return $this;
    }

    /**
     * @return Collection<int, ResearchRequest>
     */
    public function getResearchRequests(): Collection
    {
        return $this->researchRequests;
    }

    public function addResearchRequest(ResearchRequest $researchRequest): self
    {
        if (!$this->researchRequests->contains($researchRequest)) {
            $this->researchRequests[] = $researchRequest;
            $researchRequest->setResearchTemplate($this);
        }

        return $this;
    }

    public function removeResearchRequest(ResearchRequest $researchRequest): self
    {
        $this->researchRequests->removeElement($researchRequest);

        return $this;
    }
}
