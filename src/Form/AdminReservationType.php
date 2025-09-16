<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Practice;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;

class AdminReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('duration')
           /*  ->add('createdAt', DateTimeType::class,) */
            ->add('phone')
            
            ->add('doDay')
            ->add('status')
            ->add('historical')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
            ])
            ->add('practices', EntityType::class, [
                'class' => Practice::class,
                'choice_label' => 'name',
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
