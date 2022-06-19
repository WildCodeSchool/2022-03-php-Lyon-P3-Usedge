<?php

namespace App\Entity;

use App\Repository\ExternalLinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExternalLinkRepository::class)]
class ExternalLink extends Component
{
}
