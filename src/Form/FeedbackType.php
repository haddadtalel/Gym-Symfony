<?php

namespace App\Form;

use App\Entity\Feedback;
use App\Entity\Classes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    ->add('username', TextType::class, [
        'attr' => ['placeholder' => 'Your Username'],
    ])
    ->add('class', EntityType::class, [
        'class' => Classes::class,
        'choice_label' => 'category', // Adjust to the property you want to display
        'label' => 'Class',
    ])
    ->add('message', TextareaType::class, [
        'label' => 'Message',
        'attr' => ['placeholder' => 'Your Feedback Message'],
    ])->add('rating', ChoiceType::class, [
        'label' => 'Rating',
        'choices' => [
            '1 Star' => 1,
            '2 Stars' => 2,
            '3 Stars' => 3,
            '4 Stars' => 4,
            '5 Stars' => 5,
            'attr' => ['class' => 'rating-stars'],
        ],
        'expanded' => true, // Renders as radio buttons
        'multiple' => false,
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
