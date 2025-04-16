<?php

namespace App\Form;

use App\Entity\MetroTrajet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class MetroTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gareDepart', TextType::class, [
                'label' => 'Gare de départ'
            ])
            ->add('gareArrivee', TextType::class, [
                'label' => 'Gare d\'arrivée'
            ])
            ->add('heureDepart', TimeType::class, [
                'label' => 'Heure de départ',
                'widget' => 'choice',
                'input' => 'datetime',
                'with_seconds' => false
            ])
            ->add('heureArrivee', TimeType::class, [
                'label' => 'Heure d\'arrivée',
                'widget' => 'choice',
                'input' => 'datetime',
                'with_seconds' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MetroTrajet::class,
        ]);
    }
}