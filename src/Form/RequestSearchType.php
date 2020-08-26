<?php

namespace App\Form;

use App\Entity\RequestSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RequestSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postalCode', IntegerType::class, [
                'required' =>false,
                'label' => false, 
                'attr' => ['placeholder' => 'Code postal']
            ])
           /* ->add('category', ChoiceType::class, [
                'choices'=>[
                    '' => null,
                    'Assistance' => 'Assistance',
                    'Animaux' => 'Animaux',
                    'Enfance' => 'Enfance',
                    'Transport' => 'Transport',
                    'Jardinage' => 'Jardinage',
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RequestSearch::class,
            'method' => 'get',
            'csrf_protection' => false,

        ]);
    }
    public function getBlockPrefix(){
        return '';
    }
}
