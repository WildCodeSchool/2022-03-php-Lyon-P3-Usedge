<?php

namespace App\Entity;

use App\Repository\ExternalLinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExternalLinkRepository::class)]
class ExternalLink extends Component
{
    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    private string $link;

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
