<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\Authenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, Authenticator $authenticator, \Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(array('ROLE_USER'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            // send registration email
            $message = (new \Swift_Message())
                ->setSubject('Inscription à Manabi')
                ->setFrom('contact.manabi@gmail.com')
                ->setTo($user->getEmail())
                ->setBody('
                    Bonjour toi ! 
    
                    Notre petite équipe qui a durement travaillé pour donner vie à ce projet est très heureuse de te compter parmi ses premiers utilisateurs Manabi ! :) 
                    
                    Ton inscription à l’adresse ' . $user->getEmail() . ' a bien été prise en compte et tu pourras désormais t’organiser dans ton travail pour connaître différentes langues du bout des doigts ! 
                    
                    Rendez-vous au lien suivant : http://manabi.clara-cassel.fr pour commencer ton voyage linguistique !
                    
                    A toi de jouer ! 
                    
                    A très vite, 
                    L’équipe Manabi.
                ')
            ;

            $mailer->send($message);

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
