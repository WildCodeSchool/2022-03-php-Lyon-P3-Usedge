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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResearchRequest(): ?ResearchRequest
    {
        return $this->researchRequest;
    }

    public function setResearchRequest(?ResearchRequest $researchRequest): self
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
}
