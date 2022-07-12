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
        [
            'is_mandatory' => true,
            'question' => 'How satisfied are your users?',
        ],
        [
            'is_mandatory' => true,
            'question' => 'What importance would you give to your request?',
        ],
        [
            'is_mandatory' => true,
            'question' => 'How many requests have you already made with us?',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $singleChoiceNumber = 1;
        foreach (self::SINGLECHOICE as $singleChoiceValue) {
            $singleChoice = new SingleChoice();
            $singleChoice
                ->setName('single-choice')
                ->setIsMandatory($singleChoiceValue['is_mandatory'])
                ->setQuestion($singleChoiceValue['question']);
            $this->addReference('single_choice_' . $singleChoiceNumber, $singleChoice);
            $singleChoiceNumber++;
            $manager->persist($singleChoice);
        }

        $manager->flush();
    }
}
