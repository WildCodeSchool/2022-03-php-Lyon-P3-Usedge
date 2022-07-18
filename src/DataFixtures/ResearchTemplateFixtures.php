<?php

namespace App\DataFixtures;

use App\Entity\ResearchTemplate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResearchTemplateFixtures extends Fixture
{
    private const RESEARCH_TEMPLATE = [
        [
            'name' => 'Interview Request',
            'description' => 'Use this request to setup a track that will
                                focus on exploration and planning mostly interviews.',
            'icon' => 'build/images/icons/template_icon_1.png',
            'status' => 'active',
        ],
        [
            'name' => 'Visual Alternatives',
            'description' => 'If you think, for exemple, that A/B testing
                                can have an impact on improving your search...',
            'icon' => 'build/images/icons/template_icon_3.png',
            'status' => 'active',
        ],
        [
            'name' => 'Open Research',
            'description' => 'If you do not have a concrete idea on how to make
                                your request, answer this general form.',
            'icon' => 'build/images/icons/template_icon_4.png',
            'status' => 'dropped',
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        $templateNumber = 1;
        foreach (self::RESEARCH_TEMPLATE as $templateValue) {
            $researchTemplate = new ResearchTemplate();
            $researchTemplate->setName($templateValue['name']);
            $researchTemplate->setDescription($templateValue['description']);
            $researchTemplate->setCoach('Jason Brand');
            $researchTemplate->setIcon($templateValue['icon']);
            $researchTemplate->setStatus($templateValue['status']);
            $this->addReference('research_template_' . $templateNumber, $researchTemplate);
            $templateNumber++;
            $manager->persist($researchTemplate);
        }
        $manager->flush();
    }
}
