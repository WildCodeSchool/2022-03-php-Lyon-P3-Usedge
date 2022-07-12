<?php

namespace App\DataFixtures;

use App\Entity\OpenQuestion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpenQuestionFixtures extends Fixture
{
    private const OPENQUESTION = [
        [
            'name' => 'open-question',
            'is_mandatory' => true,
            'question' => 'Project name',
            'helper_text' => 'You can enter the name of the entire project or a feature.'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $openQuestionNumber = 1;
        foreach (self::OPENQUESTION as $openQuestionValue) {
            $openQuestion = new OpenQuestion();
            $openQuestion
                ->setName($openQuestionValue['name'])
                ->setIsMandatory($openQuestionValue['is_mandatory'])
                ->setQuestion($openQuestionValue['question'])
                ->setHelperText($openQuestionValue['helper_text']);
            $openQuestion->setAddAHelpertext(true);
            $this->addReference('question_' . $openQuestionNumber, $openQuestion);
            $openQuestionNumber++;
            $manager->persist($openQuestion);
        }

        $manager->flush();
    }
}
