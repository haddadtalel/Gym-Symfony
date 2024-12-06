<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Instructors;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category')
            ->add('capacity')
            ->add('description')
            ->add('ins', EntityType::class, [
                'class' => Instructors::class,
                'choice_label' => function (Instructors $instructor) {
                    return sprintf('%s', $instructor->getNom());
                }, // Display instructor's full name
                'multiple' => true,
                'expanded' => true, // Set to true if you want checkboxes instead of a dropdown
                'placeholder' => 'Choose Instructors', // Optional placeholder for the dropdown
                'label' => 'Instructors', // Optional label
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classes::class,
        ]);
    }
}
