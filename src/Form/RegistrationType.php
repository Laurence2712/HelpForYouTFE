<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('postalCode')
            ->add('city')
            /*->add('role')*/
            ->add('image_name', FileType::class, array(
                'label' => 'Photo de profil',
                //'data_class' => null,
                //'mapped' => true,
                //'requiered' => true,
                

            ))
            /*->add('image_size')
            ->add('updated_at')*/
            ->add('description')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            //->add('nbPoint', IntegerType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
          
        ]);
    }
}
