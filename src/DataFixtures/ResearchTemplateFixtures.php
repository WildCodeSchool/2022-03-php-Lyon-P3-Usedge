<?php

namespace App\DataFixtures;

use App\Entity\ResearchTemplate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ResearchTemplateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $icons = [
            'build/images/icons/template_icon_0.png',
            'build/images/icons/template_icon_1.png',
            'build/images/icons/template_icon_2.png',
            'build/images/icons/template_icon_3.png',
            'build/images/icons/template_icon_4.png',
            'build/images/icons/template_icon_5.png'
        ];
        $status = ['active', 'draft', 'dropped'];
        for ($t = 1; $t <  16; $t++) {
            $researchTemplate = new ResearchTemplate();
            $researchTemplate->setName($faker->sentence(1));
            $researchTemplate->setDescription($faker->sentence(1));
            $researchTemplate->setCoach($faker->name());
            $researchTemplate->setIcon($icons[array_rand($icons)]);
            $researchTemplate->setStatus($status[array_rand($status)]);
            $this->addReference('researchTemplate_' . $t, $researchTemplate);
            $manager->persist($researchTemplate);
        }
        $manager->flush();
    }
}
