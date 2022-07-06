<?php

namespace App\DataFixtures;

use App\Entity\AnswerRequest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnswerRequestFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $names = [
            'section',
            'single-choice',
            'open-question',
            'date-picker',
            'external-link',
            'separator',
            'multiple-choice',
            'evaluation-scale'
        ];
        for ($r = 1; $r <  46; $r++) {
            for ($a = 0; $a < rand(1, 3); $a++) {
                foreach ($names as $name) {
                    if ($name === 'multiple-choice') {
                        for ($m = 0; $m < rand(2, 4); $m++) {
                            $answerRequest = new AnswerRequest();
                            $answerRequest->setResearchRequest($this->getReference('researchRequest_' . $r));
                            $answerRequest->setName($name);
                            $answerRequest->setAnswer($faker->sentence(1));
                            $manager->persist($answerRequest);
                        }
                    } else {
                        $answerRequest = new AnswerRequest();
                        $answerRequest->setResearchRequest($this->getReference('researchRequest_' . $r));
                        $answerRequest->setName($name);
                        $answerRequest->setAnswer($faker->sentence(1));

                        $manager->persist($answerRequest);
                    }
                }
            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {

        return [

            ResearchRequestFixtures::class,

        ];
    }
}
