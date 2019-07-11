<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        // get current user
        $user        = $this->getUser();
        $firstNameMail    = '';
        $lastNameMail    = '';
        $bodyMail    = '';
        $subjectMail = '';
        $addressMail = '';

        if ($request->getMethod() == Request::METHOD_POST)
        {
            $firstNameMail = $request->request->get('contact')["firstName"];
            $lastNameMail  = $request->request->get('contact')["lastName"];
            $bodyMail      = $request->request->get('contact')["message"];
            $subjectMail   = $request->request->get('contact')["subject"];
            $addressMail   = $request->request->get('contact')["from"];
        }

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // send a message to the contact address with the form content
            $messageToContact = (new \Swift_Message())
                ->setSubject($subjectMail)
                ->setFrom($addressMail)
                ->setTo(['contact.manabi@gmail.com' => 'Contact Manabi'])
                ->setBody('Adresse mail de l\'expéditeur : ' . $addressMail . '<br/>' .
                    'Prénom et nom de l\'expéditeur : ' . $firstNameMail . ' ' . $lastNameMail . '<br/>' .
                    $bodyMail,
                    'text/html');

            $mailer->send($messageToContact);

            // send a confirmation email to the user to tell him/her that they contact us
            $messageToUser = (new \Swift_Message())
                ->setSubject('Vous avez contacté Manabi')
                ->setFrom(['contact.manabi@gmail.com' => 'Contact Manabi'])
                ->setTo($addressMail)
                ->setBody('
                    Bien le bonjour,

                    Vous avez récemment cherché à nous joindre via le formulaire de contact. Nous avons bien reçu votre demande et prendrons le temps de vous répondre dans les plus brefs délais !
                    
                    Nous restons à votre disposition ;) 
                    
                    L’équipe Manabi.
                ');

            $mailer->send($messageToUser);

            // empty the fields
            $form = $this->createForm(ContactType::class);

            // avoid resubmission after refresh
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/contact.html.twig', [
            'form'            => $form->createView()
        ]);
    }
}
