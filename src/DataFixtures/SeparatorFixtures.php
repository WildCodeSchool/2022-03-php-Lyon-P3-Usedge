<?php

namespace App\DataFixtures;

use App\Entity\Separator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SeparatorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $separator = new Separator();
        $separator
            ->setName('separator')
            ->setIsMandatory(false);
        $this->addReference('separator', $separator);
        $manager->persist($separator);

        $manager->flush();
    }
}
