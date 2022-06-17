<?php

namespace App\Entity;

use App\Repository\SingleChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SingleChoiceRepository::class)]
class SingleChoice extends Component
{
}
