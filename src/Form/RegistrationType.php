<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'Prénom',
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nom',
            ))
            ->add('address', TextType::class, array(
                'label' => 'Adresse',
            ))
            ->add('postalCode', TextType::class, array(
                'label' => 'Code postal',
            ))
            ->add('city', TextType::class, array(
                'label' => 'Ville',
            ))
            /*->add('role')*/
            ->add('image_name', FileType::class, array(
                'label' => 'Photo de profil',
                'data_class' => null,
                //'data_class' => null,
                //'mapped' => true,
                //'requiered' => true,
            ))
            /*->add('image_size')
            ->add('updated_at')*/
            ->add('description')
            ->add('email', TextType::class, array(
                'label' => 'Adresse email',
            ))
            ->add('password', PasswordType::class, array(
                'label' => 'Mot de passe',
            ))
            ->add('confirm_password', PasswordType::class, array(
                'label' => 'Confirmation du mot de passe'
            ))
            //->add('nbPoint', IntegerType::class)
           // ->add('modifier', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            
          
        ]);
    }
}
