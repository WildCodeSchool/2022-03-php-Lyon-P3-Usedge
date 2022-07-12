<?php

namespace App\DataFixtures;

use App\Entity\DatePicker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DatePickerFixtures extends Fixture
{
    private const DATEPICKERS = [
        [
            'is_mandatory' => true,
            'title' => 'What is the deadline of your research?'
        ],
        [
            'is_mandatory' => true,
            'title' => 'How long have you been working on this research?'
        ],
        [
            'is_mandatory' => false,
            'title' => 'What is the deadline of your research?'
        ],
        [
            'is_mandatory' => false,
            'title' => 'How long have you been working on this research?'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $datePickerNumber = 1;
        foreach (self::DATEPICKERS as $datePickerValue) {
            $datePicker = new DatePicker();
            $datePicker
                ->setName('date-picker')
                ->setIsMandatory($datePickerValue['is_mandatory'])
                ->setTitle($datePickerValue['title']);
            $this->addReference('date_picker_' . $datePickerNumber, $datePicker);
            $datePickerNumber++;
            $manager->persist($datePicker);
        }

        $manager->flush();
    }
}
