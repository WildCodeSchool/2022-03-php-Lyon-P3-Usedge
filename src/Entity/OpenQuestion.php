<?php

namespace App\Entity;

use App\Repository\OpenQuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: OpenQuestionRepository::class)]
class OpenQuestion extends Component
{
    #[ORM\Column(type: 'boolean', nullable: true)]
    private bool $addAHelpertext;

    public function isAddAHelpertext(): ?bool
    {
        return $this->addAHelpertext;
    }

    public function setAddAHelpertext(bool $addAHelpertext): self
    {
        $this->addAHelpertext = $addAHelpertext;

        return $this;
    }
}
