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
            'question' => 'What IT category does your project concern?',
        ],
        [
            'is_mandatory' => true,
            'question' => 'Which exercise would you prefer for your request?',
        ],
        [
            'is_mandatory' => false,
            'question' => 'If you had the two most important specifications, what it would be?',
        ],
        [
            'is_mandatory' => false,
            'question' => 'What segment population is concerned by your product ?',
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
