<?php

namespace App\Form;

use App\Entity\ReservationParking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationParkingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateReservation', null, [
                'widget' => 'single_text',
            ])
            ->add('idUtilisateur')
            ->add('idTrajetTrain')
            ->add('idTrajetMetro')
            ->add('idTrajetBus')
            ->add('idScooter')
            ->add('idTaxi')
            ->add('idParking')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationParking::class,
        ]);
    }
}
