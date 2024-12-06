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
                'attr' => [
                    'placeholder' => 'Your Username',
                    'class' => 'form-control', // Bootstrap class for styling
                ],
            ])
            ->add('class', EntityType::class, [
                'class' => Classes::class,
                'choice_label' => 'category', // Adjust this to your property name
                'attr' => ['class' => 'form-control'],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Your Feedback Message',
                    'class' => 'form-control',
                ],
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Your Rating',
                'choices' => [
                    '1 Star' => 1,
                    '2 Stars' => 2,
                    '3 Stars' => 3,
                    '4 Stars' => 4,
                    '5 Stars' => 5,
                ],
                'expanded' => true, // Displays as radio buttons
                'multiple' => false,
              'attr' => [
                    'class' => 'rating-stars',
                    'id' => 'star', // Add the "id" attribute here
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
