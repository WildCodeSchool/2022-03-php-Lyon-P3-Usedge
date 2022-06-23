<?php

namespace App\Entity;

use App\Repository\DatePickerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DatePickerRepository::class)]
class DatePicker extends Component
{
}
