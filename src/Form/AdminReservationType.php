<?php

namespace App\Form;

use App\Entity\Practice;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('duration')
            ->add('phone')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('doDay')
            ->add('status')
            ->add('historical')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
            ])
            ->add('practices', EntityType::class, [
                'class' => Practice::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
