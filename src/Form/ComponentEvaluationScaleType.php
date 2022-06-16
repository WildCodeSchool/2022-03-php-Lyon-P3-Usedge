<?php

namespace App\Form;

use App\Entity\ComponentEvaluationScale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComponentEvaluationScaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', HiddenType::class, [
                'attr' => [
                    'value' => 'evaluation-scale'
                ]
            ])
            ->add('isMandatory', CheckboxType::class, [
                'attr' => [
                    'class' => 'evaluation-scale-checkbox-mandatory',
                ],
                'label' => 'This field is mandatory',
                'label_attr' => [
                    'class' => 'evaluation-scale-label-mandatory',
                ],
                'required' => false
            ])
            ->add('question', TextType::class, [
                'attr' => [
                    'class' => 'evaluation-scale-input',
                    'placeholder' => 'What is your question'
                ],
                'required' => true
            ])
            /* ->add('isMultiple') */
            ->add('lowLabel', TextType::class, [
                'attr' => [
                    'class' => 'evaluation-scale-input',
                    'placeholder' => 'Lowest Label'
                ],
                'required' => true
            ])
            ->add('highLabel', TextType::class, [
                'attr' => [
                    'class' => 'evaluation-scale-input',
                    'placeholder' => 'Lowest Label'
                ],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ComponentEvaluationScale::class,
        ]);
    }
}
