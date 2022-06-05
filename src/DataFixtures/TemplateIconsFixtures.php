<?php

namespace App\DataFixtures;

use App\Entity\TemplateIcons;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TemplateIconsFixtures extends Fixture
{
    public const ICONS = [
        "build/images/icons/ampoule.png",
        "build/images/icons/loupe.png",
        "build/images/icons/medaille.png"
    ];

    public function load(ObjectManager $manager): void
    {
        $iconNumber = 1;
        foreach (self::ICONS as $link) {
            $icon = new TemplateIcons();
            $icon->setIcon($link);
            $this->addReference('icon_' . $iconNumber, $icon);
            $manager->persist($icon);
            $iconNumber++;
        }

        $manager->flush();
    }
}
