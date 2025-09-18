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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class AdminReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('duration')
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date du jour',
                'widget' => 'single_text',
                'required' => true,
            ])

            ->add('phone')
            
            ->add('doDay', DateTimeType::class,[
                'label' => 'Date du RDV',
                'widget' => 'single_text',
                'required' => true,

            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                'En attente' => 0,
                'Confirmé' => 1,
                'Annulé' => 2,
            ],
                'expanded' => false, // menu déroulant
                'multiple' => false, // une seule valeur
            ])
            ->add('historical', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Historique',
                'required' => false,
    ])
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
