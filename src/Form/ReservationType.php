<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomUser', TextType::class, [
            'label' => 'Nom de l\'utilisateur',
            'attr' => ['class' => 'form-control'],
            'disabled' => true, // <- pour empêcher l'édition
        ])
            ->add('moyen', ChoiceType::class, [
                'label' => 'Moyen de transport',
                'choices' => [
                    'Voiture' => 'Voiture',
                    'Bus' => 'Bus',
                    'Train' => 'Train',
                    'Métroo' => 'Métro',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateRes', DateType::class, [
                'label' => 'Date de réservation',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('moyenPaiement', ChoiceType::class, [
                'label' => 'Mode de paiement',
                'choices' => [
                    'Espèces' => 'Espèces',
                    'Carte' => 'Carte',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('confirmationCode', TextType::class, [
                'label' => 'Code de confirmation',
                'attr' => ['class' => 'form-control'],
                'disabled' => true, // Code de confirmation désactivé pour affichage uniquement
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
