<?php

namespace App\Entity;

use App\Repository\TemplateIconsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TemplateIconsRepository::class)]
class TemplateIcons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    private string $icon;

    #[ORM\OneToMany(mappedBy: 'icon', targetEntity: ResearchTemplate::class)]
    private Collection $researchTemplates;

    public function __construct()
    {
        $this->researchTemplates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, ResearchTemplate>
     */
    public function getResearchTemplates(): Collection
    {
        return $this->researchTemplates;
    }

    public function addResearchTemplate(ResearchTemplate $researchTemplate): self
    {
        if (!$this->researchTemplates->contains($researchTemplate)) {
            $this->researchTemplates[] = $researchTemplate;
            $researchTemplate->setIcon($this);
        }

        return $this;
    }

    public function removeResearchTemplate(ResearchTemplate $researchTemplate): self
    {
        if ($this->researchTemplates->removeElement($researchTemplate)) {
            // set the owning side to null (unless already changed)
            if ($researchTemplate->getIcon() === $this) {
                $researchTemplate->setIcon(null);
            }
        }

        return $this;
    }
}
