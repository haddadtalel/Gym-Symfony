<?php

namespace App\Form;

use App\Entity\Pack;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\User;
class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('user', EntityType::class, [
            'class' => User::class,
            'choice_label' => fn(User $user) => sprintf(
                '%s %s (%s)', 
                $user->getPrenom(), 
                $user->getNom(), 
                $user->getUsername()
            ), // Display full name and username in the dropdown
            'placeholder' => 'Choose a User',
        ])
        ->add('pack', EntityType::class, [
            'class' => Pack::class,
            'choice_label' => fn(Pack $pack) => sprintf(
                'Type: %s, Duration: %s, Amount: %d',
                $pack->getType()->value,
                $pack->getDuration()->value,
                $pack->getAmount()
            ), // Display meaningful pack details
            'placeholder' => 'Choose a Pack',
        ])
        ->add('payment_method', ChoiceType::class, [
            'choices' => [
                'Credit Card' => 'credit_card',
                'PayPal' => 'paypal',
                'Bank Transfer' => 'bank_transfer',
            ],
            'placeholder' => 'Select a Payment Method',
            'label' => 'Payment Method',
        ])  
            ->add('status')
            ->add('start_date', null, [
                'widget' => 'single_text',
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])
            ->add('description')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
        ]);
    }
}
