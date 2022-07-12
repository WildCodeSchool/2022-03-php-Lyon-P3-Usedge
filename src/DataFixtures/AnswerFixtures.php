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
            'question' => '1'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ANSWER as $answerValue) {
            $answer = new Answer();
            $answer
                ->setAnswer($answerValue['answer'])
                ->setNumberOrder($answerValue['number_order'])
                ->setQuestion($this->getReference('question_' . $answerValue['question']));
            $manager->persist($answer);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OpenQuestionFixtures::class,
        ];
    }
}
