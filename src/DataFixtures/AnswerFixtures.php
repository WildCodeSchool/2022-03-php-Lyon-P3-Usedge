<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Component;
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
            'answer' => 'Purpose statement...',
            'number_order' => 1,
            'question' => 'open_question_2'
        ],
        [
            'answer' => 'Research goal...',
            'number_order' => 1,
            'question' => 'open_question_3'
        ],
        [
            'answer' => 'Available data...',
            'number_order' => 1,
            'question' => 'open_question_4'
        ],
        [
            'answer' => 'Research questions...',
            'number_order' => 1,
            'question' => 'open_question_5'
        ],
        [
            'answer' => 'Add a numer...',
            'number_order' => 1,
            'question' => 'open_question_6'
        ],
        [
            'answer' => 'French, English, Spanish...',
            'number_order' => 1,
            'question' => 'open_question_7'
        ],
        [
            'answer' => 'Participant characteristics...',
            'number_order' => 1,
            'question' => 'open_question_8'
        ],
        [
            'answer' => 'Note from requestor...',
            'number_order' => 1,
            'question' => 'open_question_9'
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
            'answer' => 'Workshop',
            'number_order' => 1,
            'question' => 'multiple_choice_2'
        ],
        [
            'answer' => 'Canva',
            'number_order' => 2,
            'question' => 'multiple_choice_2'
        ],
        [
            'answer' => 'Both',
            'number_order' => 3,
            'question' => 'multiple_choice_2'
        ],
        [
            'answer' => 'UX/UI',
            'number_order' => 1,
            'question' => 'multiple_choice_3'
        ],
        [
            'answer' => 'Cost Estimation',
            'number_order' => 2,
            'question' => 'multiple_choice_3'
        ],
        [
            'answer' => 'Value proposal',
            'number_order' => 3,
            'question' => 'multiple_choice_3'
        ],
        [
            'answer' => 'Feature benefits',
            'number_order' => 4,
            'question' => 'multiple_choice_3'
        ],
        [
            'answer' => 'Ease of use',
            'number_order' => 5,
            'question' => 'multiple_choice_3'
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
        [
            'answer' => 'Not at all',
            'number_order' => 1,
            'question' => 'single_choice_2'
        ],
        [
            'answer' => 'Not very',
            'number_order' => 2,
            'question' => 'single_choice_2'
        ],
        [
            'answer' => 'Rather',
            'number_order' => 3,
            'question' => 'single_choice_2'
        ],
        [
            'answer' => 'Very',
            'number_order' => 4,
            'question' => 'single_choice_2'
        ],
        [
            'answer' => 'Not at all',
            'number_order' => 1,
            'question' => 'single_choice_3'
        ],
        [
            'answer' => 'Not very',
            'number_order' => 2,
            'question' => 'single_choice_3'
        ],
        [
            'answer' => 'Rather',
            'number_order' => 3,
            'question' => 'single_choice_3'
        ],
        [
            'answer' => 'Very',
            'number_order' => 4,
            'question' => 'single_choice_3'
        ],
        [
            'answer' => 'None',
            'number_order' => 1,
            'question' => 'single_choice_4'
        ],
        [
            'answer' => '1',
            'number_order' => 2,
            'question' => 'single_choice_4'
        ],
        [
            'answer' => '2',
            'number_order' => 3,
            'question' => 'single_choice_4'
        ],
        [
            'answer' => '3',
            'number_order' => 4,
            'question' => 'single_choice_4'
        ],
        [
            'answer' => 'More than 3',
            'number_order' => 5,
            'question' => 'single_choice_4'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ANSWER as $answerValue) {
            $answer = new Answer();
            $answer
                ->setAnswer($answerValue['answer'])
                ->setNumberOrder($answerValue['number_order']);
            if ($this->getReference($answerValue['question']) instanceof Component) {
                $answer->setQuestion($this->getReference($answerValue['question']));
            }
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
