<?php

namespace App\Form;

<<<<<<< HEAD
use App\Entity\User;
=======
>>>>>>> 589ebd67701772fba3dcbac06822db2422230f91
use App\Entity\Request;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
=======
>>>>>>> 589ebd67701772fba3dcbac06822db2422230f91

class RequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
<<<<<<< HEAD

    


=======
>>>>>>> 589ebd67701772fba3dcbac06822db2422230f91
        $builder
            ->add('category', EntityType::class, ['class' => Category::class, 
                'choice_label' => 'name',
                'label' => 'Catégorie'])
            ->add('title')
            ->add('description')
<<<<<<< HEAD
            ->add('nbPoint') 
            ->add('firstname', TextType::class)
           
      
        
        
=======
            ->add('nbPoint')
            
      
>>>>>>> 589ebd67701772fba3dcbac06822db2422230f91
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Request::class,
        ]);
    }
}
