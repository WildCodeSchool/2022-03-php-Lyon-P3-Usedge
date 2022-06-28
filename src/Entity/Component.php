<?php

namespace App\Entity;

use App\Repository\ComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ComponentRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
abstract class Component
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    protected string $name;

    #[ORM\Column(type: 'boolean')]
    protected bool $isMandatory;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    protected string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    protected string $question;

    #[ORM\Column(type: 'text', nullable: true)]
    protected string $helperText;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, cascade: ['remove'])]
    protected Collection $answers;

    #[ORM\OneToMany(mappedBy: 'component', targetEntity: TemplateComponent::class, cascade: ['remove'])]
    protected Collection $templateComponents;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->templateComponents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = ''): self
    {
            $this->name = $name;

            return $this;
    }

    public function isIsMandatory(): ?bool
    {
        return $this->isMandatory;
    }

    public function setIsMandatory(bool $isMandatory): self
    {
        $this->isMandatory = $isMandatory;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title = ''): self
    {
            $this->title = $title;

            return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question = ''): self
    {
            $this->question = $question;

            return $this;
    }

    public function getHelperText(): ?string
    {
        return $this->helperText;
    }

    public function setHelperText(string $helperText = ''): self
    {
            $this->helperText = $helperText;

            return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        $this->answers->removeElement($answer);

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
            $templateComponent->setComponent($this);
        }

        return $this;
    }

    public function removeTemplateComponent(TemplateComponent $templateComponent): self
    {
        $this->templateComponents->removeElement($templateComponent);

        return $this;
    }
}
