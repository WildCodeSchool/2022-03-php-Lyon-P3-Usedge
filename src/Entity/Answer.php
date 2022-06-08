<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'text')]
    private string $answer;

    #[ORM\Column(type: 'integer')]
    #[Assert\Type(
        type: 'integer',
        message: 'You must to enter an interger.',
    )]
    private int $numberOrder;

    #[ORM\ManyToOne(targetEntity: Component::class, inversedBy: 'answers')]
    private Component $question;

    public function getId(): int
    {
        return $this->id;
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

    public function getNumberOrder(): int
    {
        return $this->numberOrder;
    }

    public function setNumberOrder(int $numberOrder): self
    {
        $this->numberOrder = $numberOrder;

        return $this;
    }

    public function getQuestion(): ?Component
    {
        return $this->question;
    }

    public function setQuestion(?Component $question): self
    {
            $this->question = $question;

            return $this;
    }
}
