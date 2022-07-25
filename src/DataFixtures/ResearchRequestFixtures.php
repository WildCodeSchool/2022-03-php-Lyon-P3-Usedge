<?php

namespace App\DataFixtures;

use App\Entity\ResearchRequest;
use App\Entity\ResearchTemplate;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ResearchRequestFixtures extends Fixture implements DependentFixtureInterface
{
    private const RESEARCH_REQUEST = [
        [
            'research_template' => 'research_template_1',
            'status' => 'Solved',
            'project' => 'UX/UI Project',
            'owner' => 'David Martin',
        ],
        [
            'research_template' => 'research_template_1',
            'status' => 'Under review',
            'project' => 'UX/UI Project',
            'owner' => 'Pierre Dupont',
        ],
        [
            'research_template' => 'research_template_1',
            'status' => 'Waiting list',
            'project' => 'Functionnality Project',
            'owner' => 'Maryline Faisant',
        ],
        [
            'research_template' => 'research_template_2',
            'status' => 'Draft',
            'project' => 'Other Project',
            'owner' => 'Jacques Michel',
        ],
        [
            'research_template' => 'research_template_2',
            'status' => 'Dropped',
            'project' => 'Functionnality Project',
            'owner' => 'Michèle Vougeot',
        ],
        [
            'research_template' => 'research_template_2',
            'status' => 'Solved',
            'project' => 'UX/UI Project',
            'owner' => 'Ophélie Judon',
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        $requestNumber = 1;
        foreach (self::RESEARCH_REQUEST as $requestValue) {
            $researchRequest = new ResearchRequest();
            $date = new DateTime("now");
            $researchRequest
                ->setCreationDate($date)
                ->setStatus($requestValue['status'])
                ->setProject($requestValue['project'])
                ->setOwner($requestValue['owner']);
            $this->addReference('research_request_' . $requestNumber, $researchRequest);

            if ($this->getReference($requestValue['research_template']) instanceof ResearchTemplate) {
                $researchRequest->setResearchTemplate($this->getReference($requestValue['research_template']));
            }

            $requestNumber++;

            $manager->persist($researchRequest);
        }

        $manager->flush();
    }

    public function getDependencies()
    {

        return [

          ResearchTemplateFixtures::class,

        ];
    }
}
