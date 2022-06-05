<?php

namespace App\DataFixtures;

use App\Entity\TemplateStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TemplateStatusFixtures extends Fixture
{
    public const STATUS = [
        [
            "status" => "Draft",
            "icon" => "build/images/icons/grey-dot.png"
        ],
        [
            "status" => "Valide",
            "icon" => "build/images/icons/green-dot.png"
        ],
        [
            "status" => "Dropped",
            "icon" => "build/images/icons/red-dot.png"
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $statusNumber = 1;
        foreach (self::STATUS as $statusType) {
            $statusFixture = new TemplateStatus();
            $statusFixture->setStatus($statusType['status']);
            $statusFixture->setIcon($statusType['icon']);
            $this->addReference('status_' . $statusNumber, $statusFixture);
            $manager->persist($statusFixture);
            $statusNumber++;
        }

        $manager->flush();
    }
}
