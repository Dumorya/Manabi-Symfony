<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class ContactType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $email = "";

        // Test si user est AUTHENTICATED
        if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            $user = $this->security->getToken()->getUser();
            $email = $user->getEmail();
        }

        $builder
            ->add('firstName', null, [
                'attr' => ['placeholder' => 'Prénom'],
                'label' => false
            ])
            ->add('lastName', null, [
                'attr' => ['placeholder' => 'Nom'],
                'label' => false
            ])
            ->add('from', EmailType::class, [
                'attr' => ['value' => $email, 'placeholder' => 'Adresse email'],
                'label' => false
            ])
            ->add('subject', null, [
                'attr' => ['placeholder' => 'Objet'],
                'label' => false
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['placeholder' => 'Message'],
                'label' => false
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
