<?php

namespace App\DataFixtures;

use App\Entity\ResearchPlanSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResearchPlanSectionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $researchPlanSection = new ResearchPlanSection();
        $researchPlanSection
            ->setTitle('Wild Project Workshop')
            ->setWorkshopName('Explorative interview')
            ->setWorkshopDescription('Cover almost all user-related topics, gather
                                        informations on users’ feelings, motivations
                                        and daily routines, or how they use products.')
            ->setRecommendation('If you have little time, you can send the link to the
                                    "board" by asking participants to start the exercise
                                    (by indicating their initials on the post-its for example).
                                    Suggest that they tune in 15-30 minutes before the workshop
                                    if they have any questions, so as not to take away from the workshop time.')
            ->setObjectives([
                'First, define the problems and expectations.',
                'Second, hare your innovations and interact with attendees.',
                'Last, Collect information, gather it and analyze it.'
            ])
            ->setResearchPlan($this->getReference('research_plan_1'));

        $manager->persist($researchPlanSection);

        $manager->flush();
    }

    public function getDependencies()
    {

        return [

          ResearchPlanFixtures::class,

        ];
    }
}
