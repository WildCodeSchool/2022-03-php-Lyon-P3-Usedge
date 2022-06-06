<?php

namespace App\Entity;

use App\Repository\ResearchTemplateRepository;
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

    #[ORM\ManyToOne(targetEntity: TemplateIcons::class, inversedBy: 'researchTemplates')]
    #[ORM\JoinColumn(nullable: false)]
    private TemplateIcons $icon;

    #[ORM\ManyToOne(targetEntity: TemplateStatus::class, inversedBy: 'researchTemplates')]
    private TemplateStatus $status;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    private string $coach;

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

    public function getIcon(): ?TemplateIcons
    {
        return $this->icon;
    }

    public function setIcon(?TemplateIcons $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getStatus(): ?TemplateStatus
    {
        return $this->status;
    }

    public function setStatus(?TemplateStatus $status): self
    {
        $this->status = $status;

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
}
