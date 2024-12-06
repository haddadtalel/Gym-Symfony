<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Schedules;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchedulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_time', null, [
                'widget' => 'single_text',
                'label' => 'Start Time',
            ])
            ->add('end_time', null, [
                'widget' => 'single_text',
                'label' => 'End Time',
            ])
            ->add('room', null, [
                'label' => 'Room',
            ])
            ->add('classes', EntityType::class, [ // Change to match the Schedule entity's property
                'class' => Classes::class,
                'choice_label' => 'category', // Displays the class name
                'multiple' => true, // Allows selecting multiple classes
                'expanded' => true, // Shows checkboxes instead of a dropdown
                'group_by' => function (Classes $class) {
                    return $class->getCategory(); // Groups classes by category
                },
                'label' => 'Classes',
                'placeholder' => 'Choose one or more classes', // Optional placeholder
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Schedules::class,
        ]);
    }
}
