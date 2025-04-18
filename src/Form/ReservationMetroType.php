<?php
namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Metro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationMetroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('moyen', EntityType::class, [
                'class' => Metro::class,
                'choice_label' => 'numeroMetro',
                'label' => 'Numéro de métro',
                'placeholder' => 'Sélectionnez un métro',
                'choices' => $options['metros'],
                'attr' => ['class' => 'form-select']
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de réservation',
                'attr' => ['class' => 'form-control']
            ])
            ->add('moyenPaiement', ChoiceType::class, [
                'choices' => [
                    'Carte' => 'Carte',
                    'Espèces' => 'Espèces',
                ],
                'label' => 'Moyen de paiement',
                'placeholder' => 'Sélectionnez un moyen',
                'attr' => ['class' => 'form-select']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'metros' => [],
        ]);
    }
}