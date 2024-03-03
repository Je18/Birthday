<?php

namespace App\Form;

use App\Entity\Birthday;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType as TypeBirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirthdayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, ['label' => 'Nom de famille : '])
            ->add('Prenom', TextType::class, ['label' => 'Prenom : '])
            ->add('Date', TypeBirthdayType::class, [
                'label' => "Date d'anniversaire : ",
                'widget' => 'single_text',
                'years' => range(date('Y')- 100, date('Y'))
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Birthday::class,
        ]);
    }
}
