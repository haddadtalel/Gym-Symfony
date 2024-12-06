<?php

namespace App\Form;

use App\Entity\NutritionPlans;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NutritionPlansType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'username',
            'placeholder' => 'Choose a User',
            'required' => true,  // Make sure it's required
        ])
            ->add('meal_detail')
            ->add('calories')
            ->add('start_date', null, [
                'widget' => 'single_text',
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NutritionPlans::class,
        ]);
    }
}
