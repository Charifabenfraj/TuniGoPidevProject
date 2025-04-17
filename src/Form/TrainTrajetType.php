<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType; // pour tous les champs string
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\TrainTrajet;
use App\Entity\Train;
use Symfony\Component\Validator\Constraints\NotBlank; // <-- Ajoutez cette ligne
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class TrainTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('train', EntityType::class, [
            'class' => Train::class,
            'choice_label' => 'numeroTrain',
            'placeholder' => 'Choisir un train',
            'constraints' => [
                new NotBlank(message: 'Le train est obligatoire.')
            ]
        ])
        ->add('gareDepart')
        ->add('gareArrivee')
        ->add('heureDepart')
        ->add('heureArrivee');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrainTrajet::class,
        ]);
    }
}
