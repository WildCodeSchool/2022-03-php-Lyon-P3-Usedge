<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswerFixtures extends Fixture implements DependentFixtureInterface
{
    private const ANSWER = [
        [
            'answer' => 'Project name...',
            'number_order' => 1,
            'question' => 'open_question_1'
        ],
        [
            'answer' => 'Analytics',
            'number_order' => 1,
            'question' => 'multiple_choice_1'
        ],
        [
            'answer' => 'Cloud computing',
            'number_order' => 2,
            'question' => 'multiple_choice_1'
        ],
        [
            'answer' => 'Infrastructure',
            'number_order' => 3,
            'question' => 'multiple_choice_1'
        ],
        [
            'answer' => 'Software/application development',
            'number_order' => 4,
            'question' => 'multiple_choice_1'
        ],
        [
            'answer' => 'Less than 4 weeks',
            'number_order' => 1,
            'question' => 'single_choice_1'
        ],
        [
            'answer' => '4 to 8 weeks',
            'number_order' => 2,
            'question' => 'single_choice_1'
        ],
        [
            'answer' => '8 to 12 weeks',
            'number_order' => 3,
            'question' => 'single_choice_1'
        ],
        [
            'answer' => 'more than 12 weeks',
            'number_order' => 4,
            'question' => 'single_choice_1'
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ANSWER as $answerValue) {
            $answer = new Answer();
            $answer
                ->setAnswer($answerValue['answer'])
                ->setNumberOrder($answerValue['number_order'])
                ->setQuestion($this->getReference($answerValue['question']));
            $manager->persist($answer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OpenQuestionFixtures::class,
            MultipleChoiceFixtures::class,
            SingleChoiceFixtures::class,
        ];
    }
}
