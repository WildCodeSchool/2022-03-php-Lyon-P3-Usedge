<?php

namespace App\Form;

use App\Entity\ResearchTemplate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResearchTemplateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('icon', ChoiceType::class, [
                'label' => 'Select an icon :',
                'label_attr' => [
                    'class' => 'modal-icon-select-label-name'
                ],
                'choices' => [
                    '1'
                    => 'build\images\icons\template_icon_0.png',
                    '2'
                    => 'build\images\icons\template_icon_1.png',
                    '3'
                    => 'build\images\icons\template_icon_2.png',
                    '4'
                    => 'build\images\icons\template_icon_3.png',
                    '5'
                    => 'build\images\icons\template_icon_4.png',
                    '6'
                    => 'build\images\icons\template_icon_5.png',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('name', TextType::class, [
                'label' => 'Name',
                'label_attr' => [
                    'class' => 'modal-label'
                ],
                'attr' => [
                    'placeholder' => 'Write down your research request name',
                    'class' => 'modal-input'
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'modal-label'
                ],
                'attr' => [
                    'placeholder' => 'Write down the project description here',
                    'class' => 'modal-input'
                ]
            ])
            ->add('coach', ChoiceType::class, [
                'label' => 'Assigned coach',
                'placeholder' => 'Select a project owner',
                'label_attr' => [
                    'class' => 'modal-coach-select-label'
                ],
                'attr' => [
                    'class' => 'modal-input'
                ],
                'choices' => [
                    'John Doe' => 'John Doe',
                    'Jane Doe' => 'Jane Doe',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResearchTemplate::class,
        ]);
    }
}
