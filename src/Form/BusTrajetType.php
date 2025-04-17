<?php

namespace App\Form;

use App\Entity\BusTrajet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

use App\Entity\Bus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BusTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('stationDepart')
        ->add('stationArrivee')
        ->add('heureDepart', TextType::class, [
            'label' => 'Heure de départ',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'HH:MM',
                'pattern' => '([01][0-9]|2[0-3]):[0-5][0-9]',
                'title' => 'Format 24h (ex: 14:30)'
            ]
        ])
        ->add('heureArrivee', TextType::class, [
            'label' => 'Heure d\'arrivée',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'HH:MM',
                'pattern' => '([01][0-9]|2[0-3]):[0-5][0-9]',
                'title' => 'Format 24h (ex: 16:45)'
            ]
        ])
        ->add('bus', EntityType::class, [
            'class' => Bus::class,
            'choice_label' => 'numeroBus', // Affiche le numéro de bus
            'choice_value' => 'idBus',     // Utilise l'ID comme valeur soumise
            'placeholder' => 'Choisir un bus',
            'required' => true
        ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BusTrajet::class,
        ]);
    }
}
