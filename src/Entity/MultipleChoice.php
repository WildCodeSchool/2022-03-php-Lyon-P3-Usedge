<?php

namespace App\Entity;

use App\Repository\MultipleChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultipleChoiceRepository::class)]
class MultipleChoice extends Component
{
}
