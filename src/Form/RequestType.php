<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Request;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    


        $builder
            ->add('category', EntityType::class, ['class' => Category::class, 
                'choice_label' => 'name',
                'label' => 'Catégorie'])
            ->add('title')
            ->add('description')
            ->add('nbPoint') 
            ->add('firstname', TextType::class)
           
      
        
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Request::class,
        ]);
    }
}
