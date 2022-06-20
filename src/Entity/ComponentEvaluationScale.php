<?php

namespace App\Entity;

use App\Repository\ComponentEvaluationScaleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ComponentEvaluationScaleRepository::class)]
class ComponentEvaluationScale extends Component
{
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    private string $lowLabel;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'This field is mandatory.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Maximum length is 255 characters.'
    )]
    private string $highLabel;

    public function getLowLabel(): ?string
    {
        return $this->lowLabel;
    }

    public function setLowLabel(string $lowLabel): self
    {
        $this->lowLabel = $lowLabel;

        return $this;
    }

    public function getHighLabel(): ?string
    {
        return $this->highLabel;
    }

    public function setHighLabel(string $highLabel): self
    {
        $this->highLabel = $highLabel;

        return $this;
    }
}
