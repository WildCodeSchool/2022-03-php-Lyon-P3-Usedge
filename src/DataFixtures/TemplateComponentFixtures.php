<?php

namespace App\DataFixtures;

use App\Entity\Component;
use App\Entity\ResearchTemplate;
use App\Entity\TemplateComponent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TemplateComponentFixtures extends Fixture implements DependentFixtureInterface
{
    private const TEMPLATE_COMPONENT = [
        [
            'research_template' => 'research_template_1',
            'component' => 'section_1',
            'order_number' => 1,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'open_question_1',
            'order_number' => 2,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'open_question_2',
            'order_number' => 3,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'section_4',
            'order_number' => 4,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'open_question_6',
            'order_number' => 5,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'separator',
            'order_number' => 6,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'section_3',
            'order_number' => 7,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'evaluation_scale_2',
            'order_number' => 8,
        ],
        [
            'research_template' => 'research_template_1',
            'component' => 'multiple_choice_1',
            'order_number' => 9,
        ],

        [
            'research_template' => 'research_template_2',
            'component' => 'section_1',
            'order_number' => 1,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'open_question_1',
            'order_number' => 2,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'section_2',
            'order_number' => 3,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'open_question_3',
            'order_number' => 4,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'open_question_4',
            'order_number' => 5,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'open_question_5',
            'order_number' => 6,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'separator',
            'order_number' => 7,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'section_5',
            'order_number' => 8,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'external_link_1',
            'order_number' => 9,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'date_picker_3',
            'order_number' => 10,
        ],
        [
            'research_template' => 'research_template_2',
            'component' => 'open_question_9',
            'order_number' => 11,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'section_1',
            'order_number' => 1,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'open_question_1',
            'order_number' => 2,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'section_4',
            'order_number' => 3,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'open_question_6',
            'order_number' => 4,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'open_question_7',
            'order_number' => 5,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'evaluation_scale_2',
            'order_number' => 6,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'separator',
            'order_number' => 7,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'section_3',
            'order_number' => 8,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'external_link_2',
            'order_number' => 9,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'date_picker_3',
            'order_number' => 10,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'evaluation_scale_1',
            'order_number' => 11,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'single_choice_3',
            'order_number' => 12,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'single_choice_4',
            'order_number' => 13,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'section_5',
            'order_number' => 14,
        ],
        [
            'research_template' => 'research_template_3',
            'component' => 'open_question_9',
            'order_number' => 15,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'section_1',
            'order_number' => 1,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'single_choice_5',
            'order_number' => 2,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'open_question_10',
            'order_number' => 3,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'open_question_11',
            'order_number' => 4,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'external_link_3',
            'order_number' => 5,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'separator',
            'order_number' => 6,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'section_6',
            'order_number' => 7,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'open_question_12',
            'order_number' => 8,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'open_question_3',
            'order_number' => 9,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'multiple_choice_4',
            'order_number' => 10,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'single_choice_6',
            'order_number' => 11,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'evaluation_scale_2',
            'order_number' => 12,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'date_picker_3',
            'order_number' => 13,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'section_7',
            'order_number' => 14,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'evaluation_scale_1',
            'order_number' => 15,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'section_8',
            'order_number' => 16,
        ],
        [
            'research_template' => 'research_template_4',
            'component' => 'open_question_9',
            'order_number' => 17,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TEMPLATE_COMPONENT as $tempComponentValue) {
            $templateComponent = new TemplateComponent();
            $templateComponent->setNumberOrder($tempComponentValue['order_number']);

            if ($this->getReference($tempComponentValue['research_template']) instanceof ResearchTemplate) {
                $templateComponent->setResearchTemplate($this->getReference($tempComponentValue['research_template']));
            }

            if ($this->getReference($tempComponentValue['component']) instanceof Component) {
                $templateComponent->setComponent($this->getReference($tempComponentValue['component']));
            }

            $manager->persist($templateComponent);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ResearchTemplateFixtures::class,
            SectionFixtures::class,
            OpenQuestionFixtures::class,
            SeparatorFixtures::class,
            SingleChoiceFixtures::class,
            MultipleChoiceFixtures::class,
            ExternalLinkFixtures::class,
            DatePickerFixtures::class,
            EvaluationScaleFixtures::class,
        ];
    }
}
