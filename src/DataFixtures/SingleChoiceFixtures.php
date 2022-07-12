<?php

namespace App\DataFixtures;

use App\Entity\SingleChoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SingleChoiceFixtures extends Fixture
{
    private const SINGLECHOICE = [
        [
            'is_mandatory' => false,
            'question' => 'How soon do you expect to complete this research?',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $singleChoiceNumber = 1;
        foreach (self::SINGLECHOICE as $singleChoiceValue) {
            $singleChoice = new SingleChoice();
            $singleChoice
                ->setName('multiple-choice')
                ->setIsMandatory($singleChoiceValue['is_mandatory'])
                ->setQuestion($singleChoiceValue['question']);
            $this->addReference('single_choice_' . $singleChoiceNumber, $singleChoice);
            $singleChoiceNumber++;
            $manager->persist($singleChoice);
        }

        $manager->flush();
    }
}
