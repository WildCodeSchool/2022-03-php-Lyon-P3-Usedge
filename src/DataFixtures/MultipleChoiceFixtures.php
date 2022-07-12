<?php

namespace App\DataFixtures;

use App\Entity\MultipleChoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MultipleChoiceFixtures extends Fixture
{
    private const MULTIPLECHOICE = [
        [
            'is_mandatory' => false,
            'question' => 'what IT category does your project concern?',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $multipleChoiceNumber = 1;
        foreach (self::MULTIPLECHOICE as $multipleChoiceValue) {
            $multipleChoice = new MultipleChoice();
            $multipleChoice
                ->setName('multiple-choice')
                ->setIsMandatory($multipleChoiceValue['is_mandatory'])
                ->setQuestion($multipleChoiceValue['question']);
            $this->addReference('multiple_choice_' . $multipleChoiceNumber, $multipleChoice);
            $multipleChoiceNumber++;
            $manager->persist($multipleChoice);
        }

        $manager->flush();
    }
}
