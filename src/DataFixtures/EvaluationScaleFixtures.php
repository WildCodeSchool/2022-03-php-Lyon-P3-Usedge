<?php

namespace App\DataFixtures;

use App\Entity\ComponentEvaluationScale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EvaluationScaleFixtures extends Fixture
{
    private const EVALUATIONSCALE = [
        [
            'is_mandatory' => false,
            'question' => 'How would you rate your confidence on the subject?',
            'low_label' => 'Not confident',
            'high_label' => 'Total confidence',
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
            $this->addReference('evaluation_scale' . $evalScaleNumber, $evaluationScale);
            $evalScaleNumber++;
            $manager->persist($evaluationScale);
        }

        $manager->flush();
    }
}
