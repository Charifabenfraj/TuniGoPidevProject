<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType; // pour tous les champs string
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\TrainTrajet;

class TrainTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gareDepart', TextType::class, [
                'label' => 'Gare départ',
                'attr'  => ['class'=>'form-control'],
            ])
            ->add('gareArrivee', TextType::class, [
                'label' => 'Gare arrivée',
                'attr'  => ['class'=>'form-control'],
            ])
            ->add('heureDepart', TextType::class, [
                'label' => 'Heure départ',
                'attr'  => [
                    'type' => 'time',       // <-- HTML5 time
                    'class'=> 'form-control'
                ],
            ])
            ->add('heureArrivee', TextType::class, [
                'label' => 'Heure arrivée',
                'attr'  => [
                    'type' => 'time',
                    'class'=> 'form-control'
                ],
            ])
            ->add('numeroTrain', TextType::class, [
                'label' => 'Numéro de train',
                'attr'  => ['class'=>'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrainTrajet::class,
        ]);
    }
}
