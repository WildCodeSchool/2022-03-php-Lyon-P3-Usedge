<?php

namespace App\Form;

use App\Entity\OpenQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpenQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('isMandatory')
            ->add('title')
            ->add('open_question-question')
            ->add('helperText')
            ->add('addAHelpertext')
            ->add('open_question-answer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OpenQuestion::class,
        ]);
    }
}
