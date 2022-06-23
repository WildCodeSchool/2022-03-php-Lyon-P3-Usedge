<?php

namespace App\Entity;

use App\Repository\SelectorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectorRepository::class)]
class Selector extends Component
{
}
