<?php

namespace App\Entity;

use App\Repository\TemplateComponentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TemplateComponentRepository::class)]
class TemplateComponent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: ResearchTemplate::class, inversedBy: 'templateComponents')]
    private ResearchTemplate $researchTemplate;

    #[ORM\ManyToOne(targetEntity: Component::class, inversedBy: 'templateComponents')]
    private Component $component;

    #[ORM\Column(type: 'integer')]
    #[Assert\Type(
        type: 'integer',
        message: 'You must to enter an interger.',
    )]
    private int $numberOrder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResearchTemplate(): ?ResearchTemplate
    {
        return $this->researchTemplate;
    }

    public function setResearchTemplate(ResearchTemplate $researchTemplate): self
    {
        $this->researchTemplate = $researchTemplate;

        return $this;
    }

    public function getComponent(): ?Component
    {
        return $this->component;
    }

    public function setComponent(Component $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function getNumberOrder(): int
    {
        return $this->numberOrder;
    }

    public function setNumberOrder(int $numberOrder): self
    {
        $this->numberOrder = $numberOrder;

        return $this;
    }
}
