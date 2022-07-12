<?php

namespace App\DataFixtures;

use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionFixtures extends Fixture
{
    private const SECTION_TITLES = [
        'Requestor',
        'Research objectives',
        'Research questions',
        'Research participants',
        'Notes & additional comments'
    ];

    public function load(ObjectManager $manager): void
    {
        $sectionNumber = 1;
        foreach (self::SECTION_TITLES as $sectionTitle) {
            $section = new Section();
            $section
                ->setName('section')
                ->setIsMandatory(false)
                ->setTitle($sectionTitle);
                $this->addReference('section_' . $sectionNumber, $section);
                $sectionNumber++;
                $manager->persist($section);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
