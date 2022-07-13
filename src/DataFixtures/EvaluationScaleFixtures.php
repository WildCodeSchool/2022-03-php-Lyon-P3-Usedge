<?php

namespace App\DataFixtures;

use App\Entity\ComponentEvaluationScale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EvaluationScaleFixtures extends Fixture
{
    private const EVALUATIONSCALE = [
        [
            'is_mandatory' => true,
            'question' => 'How would you rate your confidence on the subject?',
            'low_label' => 'Not confident',
            'high_label' => 'Total confidence',
        ],
        [
            'is_mandatory' => true,
            'question' => 'From 1 to 5, what is the progress of your idea?',
            'low_label' => '1',
            'high_label' => '5',
        ],
        [
            'is_mandatory' => true,
            'question' => 'What importance would you give to your research?',
            'low_label' => 'Few',
            'high_label' => 'A lot',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $evalScaleNumber = 1;
        foreach (self::EVALUATIONSCALE as $evaluationScaleValue) {
            $evaluationScale = new ComponentEvaluationScale();
            $evaluationScale
                ->setName('evaluation-scale')
                ->setIsMandatory($evaluationScaleValue['is_mandatory'])
                ->setQuestion($evaluationScaleValue['question']);
            $evaluationScale->setLowLabel($evaluationScaleValue['low_label']);
            $evaluationScale->setHighLabel($evaluationScaleValue['high_label']);
            $this->addReference('evaluation_scale_' . $evalScaleNumber, $evaluationScale);
            $evalScaleNumber++;
            $manager->persist($evaluationScale);
        }

        $manager->flush();
    }
}
