<?php

namespace App\Form;

use App\Entity\Practice;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            /* ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
            ]) */

             ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
             ])

            
            ->add('title', TextType::class, [
                'label' => 'Objet',
                'required' => true,
                'attr' => ['placeholder' => '1er RDV, Motif']
            ])
                
            ->add('duration', TextType::class, [
                 'label' => 'Duree',
                 'data' => '45 minutes',
                 'disabled' => true,
                 'attr' => ['readonly' => true,]
            ])

            

            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
            ])
            /* ->add('createdAt', DateTimeType::class, [
                'label' => 'Date du jour',
                'widget' => 'single_text',
                'required' => true,
            ]) */
            ->add('doDay', DateTimeType::class, [
                'label' => 'Date du RDV',
                'required' => true,
            
            ])
            
           /*  ->add('historical')
           
            ->add('practices', EntityType::class, [
                'class' => Practice::class,
                'choice_label' => 'name',
                'multiple' => true,
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
