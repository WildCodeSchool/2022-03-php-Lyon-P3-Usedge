<?php

namespace App\DataFixtures;

use App\Entity\CanvasWorkshops;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CanvasWorkshopsFixtures extends Fixture
{
    private const WORKSHOPS = [
        [
            'name' => 'Preference testing',
            'description' => 'Put a new interface in competition
                                with a control interface and evaluate the
                                performance of one against the other.',
            'picture' => 'build/images/logo_workshop/preference-testing.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Value proposition',
            'description' => 'Put a new interface in competition
                                with a control interface and evaluate the
                                performance of one against the other.',
            'picture' => 'build/images/logo_workshop/preference-testing.png',
            'type' => 'canva',
        ],
        [
            'name' => 'Card sorting',
            'description' => 'Create specific categories and list diverse
                                elements. Organize the different elements
                                depending on the categories available.',
            'picture' => 'build/images/logo_workshop/card-sorting.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Hypothesis statement',
            'description' => 'Create specific categories and list diverse
                                elements. Organize the different elements
                                depending on the categories available.',
            'picture' => 'build/images/logo_workshop/card-sorting.png',
            'type' => 'canva',
        ],
        [
            'name' => 'Explorative interview',
            'description' => 'Cover almost all user-related topics, gather
                                informations on users’ feelings, motivations
                                and daily routines, or how they use products.',
            'picture' => 'build/images/logo_workshop/explorative-interview.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Problem statement',
            'description' => 'Cover almost all user-related topics, gather
                                informations on users’ feelings, motivations
                                and daily routines, or how they use products.',
            'picture' => 'build/images/logo_workshop/explorative-interview.png',
            'type' => 'canva',
        ],
        [
            'name' => 'Buy a feature',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/buy-a-feature.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Lean UX canvas',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/buy-a-feature.png',
            'type' => 'canva',
        ],
        [
            'name' => 'Storyboard',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/buy-a-feature.png',
            'type' => 'canva',
        ],
        [
            'name' => 'Heart, head, hand',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/buy-a-feature.png',
            'type' => 'canva',
        ],
        [
            'name' => 'SWOT analysis',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/buy-a-feature.png',
            'type' => 'canva',
        ],
        [
            'name' => 'Crazy eight',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/crazy-eight.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Feature cost estimation',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/buy-a-feature.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Concept testing',
            'description' => 'Obtain rapid user feedbacks on an interface about
                                specific usage scenarios. Use them to build concrete
                                insights.',
            'picture' => 'build/images/logo_workshop/concept-testing.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'How might we?',
            'description' => 'Obtain rapid user feedbacks on an interface about
                                specific usage scenarios. Use them to build concrete
                                insights.',
            'picture' => 'build/images/logo_workshop/concept-testing.png',
            'type' => 'canva',
        ],
        [
            'name' => 'User testing',
            'description' => 'Collect the opinions and feelings of users about
                                an interface, a feature, or a service, early in
                                the life of the project.',
            'picture' => 'build/images/logo_workshop/user-testing.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Customer journey',
            'description' => 'Prioritize the features to achieve a minimum viable
                                product. Evaluate together the different pricing of
                                each feature.',
            'picture' => 'build/images/logo_workshop/customer-journey.png',
            'type' => 'workshop',
        ],
        [
            'name' => 'Assumtins mapping',
            'description' => 'List assumptions by using the guide provided. Then position
                                them to identify next your next investigation subjects.',
            'picture' => 'build/images/logo_workshop/assumtions-mapping.png',
            'type' => 'workshop',
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::WORKSHOPS as $workshop) {
            $canvaWorkshop = new CanvasWorkshops();
            $canvaWorkshop
                ->setName($workshop['name'])
                ->setDescription($workshop['description'])
                ->setImage($workshop['picture'])
                ->setType($workshop['type']);

            $manager->persist($canvaWorkshop);
        }

        $manager->flush();
    }
}
