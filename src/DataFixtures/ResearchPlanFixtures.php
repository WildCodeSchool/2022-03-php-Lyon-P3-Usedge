<?php

namespace App\DataFixtures;

use App\Entity\ResearchPlan;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResearchPlanFixtures extends Fixture implements DependentFixtureInterface
{
    private const RESEARCH_PLAN = [
        [
            'research_request' => 'research_request_1',
            'coach' => 'Jason Brand',
            'status' => 'Validated'
        ],
        [
            'research_request' => 'research_request_6',
            'coach' => 'Jason Brand',
            'status' => 'Draft'
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        $researchPlanNumber = 1;
        foreach (self::RESEARCH_PLAN as $researchPlanValue) {
            $researchPlan = new ResearchPlan();
            $date = new DateTime("now");
            $researchPlan
                ->setResearchRequest($this->getReference($researchPlanValue['research_request']))
                ->setCoach($researchPlanValue['coach'])
                ->setStatus($researchPlanValue['status'])
                ->setCreationDate($date);
            $this->addReference('research_plan_' . $researchPlanNumber, $researchPlan);
            $researchPlanNumber++;

            $manager->persist($researchPlan);
        }

        $manager->flush();
    }

    public function getDependencies()
    {

        return [

          ResearchRequestFixtures::class,

        ];
    }
}
