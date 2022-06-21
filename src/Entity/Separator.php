<?php

namespace App\Entity;

use App\Repository\SeparatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeparatorRepository::class)]
class Separator extends Component
{
}
