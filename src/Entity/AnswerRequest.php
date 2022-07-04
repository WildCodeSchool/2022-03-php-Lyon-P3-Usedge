<?php

namespace App\Entity;

use App\Repository\AnswerRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRequestRepository::class)]
class AnswerRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: ResearchRequest::class, inversedBy: 'answerRequests')]
    private ResearchRequest $researchRequest;

    #[ORM\Column(type: 'text')]
    private string $answer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResearchRequest(): ?ResearchRequest
    {
        return $this->researchRequest;
    }

    public function setResearchRequest(?ResearchRequest $researchRequest): ?self
    {
        $this->researchRequest = $researchRequest;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ?self
    {
        $this->name = $name;

        return $this;
    }
}
