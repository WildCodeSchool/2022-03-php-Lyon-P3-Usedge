<?php

namespace App\DataFixtures;

use App\Entity\OpenQuestion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpenQuestionFixtures extends Fixture
{
    private const OPENQUESTION = [
        [
            'is_mandatory' => true,
            'question' => 'Project name',
            'helper_text' => 'You can enter the name of the entire project or a feature.'
        ],
        [
            'is_mandatory' => true,
            'question' => 'Purpose statement',
            'helper_text' => 'Describe in few words the purpose statement.'
        ],
        [
            'is_mandatory' => true,
            'question' => 'Research goal',
            'helper_text' => 'Tell us what is the goal of your research request.'
        ],
        [
            'is_mandatory' => false,
            'question' => 'Available data',
            'helper_text' => 'If you have, give us the list of available datas.'
        ],
        [
            'is_mandatory' => false,
            'question' => 'Research questions',
            'helper_text' => 'You have some questions about your research? let them here.'
        ],
        [
            'is_mandatory' => true,
            'question' => 'Number of participants',
            'helper_text' => 'In function of the number, we\'ll propose adaptive workshops.'
        ],
        [
            'is_mandatory' => false,
            'question' => 'Language of the participans',
            'helper_text' => 'French or english canvas/workshops available.'
        ],
        [
            'is_mandatory' => false,
            'question' => 'Participant characteristics',
            'helper_text' => 'Users, Admins, Customers or other. Tell us.'
        ],
        [
            'is_mandatory' => false,
            'question' => 'Note from requestor',
            'helper_text' => 'Everything you want us to know.'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $openQuestionNumber = 1;
        foreach (self::OPENQUESTION as $openQuestionValue) {
            $openQuestion = new OpenQuestion();
            $openQuestion
                ->setName('open-question')
                ->setIsMandatory($openQuestionValue['is_mandatory'])
                ->setQuestion($openQuestionValue['question'])
                ->setHelperText($openQuestionValue['helper_text']);
            $openQuestion->setAddAHelpertext(true);
            $this->addReference('open_question_' . $openQuestionNumber, $openQuestion);
            $openQuestionNumber++;
            $manager->persist($openQuestion);
        }

        $manager->flush();
    }
}
