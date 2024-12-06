<?php

namespace App\Form;

use App\Entity\Pack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Type\PackTypeEnum;
use App\Type\DurationTypeEnum;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class PackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Basic' => PackTypeEnum::basic,
                    'Premium' => PackTypeEnum::premium,
                    'VIP' => PackTypeEnum::vip,
                ],
                'choice_label' => function ($choice) {
                    return $choice->value;
                },
            ])
            ->add('duration', ChoiceType::class, [
                'choices' => [
                    'Yearly' => PackTypeEnum::YEARLY,
                    'Monthly' => PackTypeEnum::MONTHLY,
                ],
                'choice_label' => function ($choice) {
                    return $choice->value; 
                },
            ])
            ->add('amount');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pack::class,
        ]);
    }
}
