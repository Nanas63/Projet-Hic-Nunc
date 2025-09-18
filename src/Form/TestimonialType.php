<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Testimonial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TestimonialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label'=> "Contenu",
            ])
            ->add('createdAt', null, [
                'label' => 'Date du jour',
                'widget' => 'single_text',
            ])
            ->add('visible', CheckboxType::class, [
                'label' => 'Visible',
                'required' => false,

                'label_attr' => ['class' => 'form-label'],
                'row_attr' => ['class' => 'mb-3 row'],
                'attr' => ['class' => 'form-switch'],
            ])
                

            ->add('firstName', TextType::class,[
                'label'=> "Prénom",
            ])
            /* ->add('lastName') */
            /* ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Testimonial::class,
        ]);
    }
}
