<?php

namespace App\DataFixtures;

use App\Entity\ResearchPlan;
use App\Entity\ResearchRequest;
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
        [
            'research_request' => 'research_request_5',
            'coach' => 'Jason Brand',
            'status' => 'Validated'
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        $researchPlanNumber = 1;
        foreach (self::RESEARCH_PLAN as $researchPlanValue) {
            $researchPlan = new ResearchPlan();
            $date = new DateTime("now");
            $researchPlan
                ->setCoach($researchPlanValue['coach'])
                ->setStatus($researchPlanValue['status'])
                ->setCreationDate($date);
            $this->addReference('research_plan_' . $researchPlanNumber, $researchPlan);
            if ($this->getReference($researchPlanValue['research_request']) instanceof ResearchRequest) {
                $researchPlan->setResearchRequest($this->getReference($researchPlanValue['research_request']));
            }
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
