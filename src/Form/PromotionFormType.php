<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\Promotion;
use App\Entity\Year;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PromotionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree', EntityType::class, [
                'label'=> 'Formation associée',
                'class'=> Degree::class,
                'choice_label' => 'name'
            ])
            ->add('year', EntityType::class, [
                'label' => 'Année associée',
                'class' => Year::class,
                'choice_label' => 'title'
            ])
            ->add('startDate',  DateTimeType::class, [
                'label' => 'Début d\'année'
            ])
            ->add('endDate',  DateTimeType::class, [
                'label' => 'Fin d\'année'
            ])
            ->add('notes', TextType::class, [
                'label' => 'Notes'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
