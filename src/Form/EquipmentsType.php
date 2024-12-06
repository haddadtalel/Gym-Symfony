<?php

namespace App\Form;

use App\Entity\Classes;
use App\Entity\Equipments;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('Eqcondition')
            ->add('last_maint_date', null, [
                'widget' => 'single_text',
            ])
            ->add('class', EntityType::class, [
                'class' => Classes::class,
                'choice_label' => 'category', // Display the category of the class
                'multiple' => true,
                'expanded' => true,
                'group_by' => function (Classes $class) {
                    return $class->getCategory(); // Group classes by category
                },
                'placeholder' => 'Choose a Class', // Placeholder for the dropdown
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipments::class,
        ]);
    }
}
