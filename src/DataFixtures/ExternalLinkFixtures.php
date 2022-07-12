<?php

namespace App\DataFixtures;

use App\Entity\ExternalLink;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExternalLinkFixtures extends Fixture
{
    private const EXTERNALLINKS = [
        [
            'is_mandatory' => true,
            'title' => 'Paste here the link to relevant docs.'
        ],
        [
            'is_mandatory' => false,
            'title' => 'Paste here the link of concerning website.'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        $externalLinkNumber = 1;
        foreach (self::EXTERNALLINKS as $externalLinkValue) {
            $externalLink = new ExternalLink();
            $externalLink
                ->setName('external_link')
                ->setIsMandatory($externalLinkValue['is_mandatory'])
                ->setTitle($externalLinkValue['title']);
            $this->addReference('external_link_' . $externalLinkNumber, $externalLink);
            $externalLinkNumber++;
            $manager->persist($externalLink);
        }

        $manager->flush();
    }
}
