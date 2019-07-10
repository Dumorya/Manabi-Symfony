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
        $bodyMail    = '';
        $subjectMail = '';
        $addressMail = '';

        if ($request->getMethod() == Request::METHOD_POST)
        {
            $bodyMail    = $request->request->get('contact')["message"];
            $subjectMail = $request->request->get('contact')["subject"];
            $addressMail = $request->request->get('contact')["from"];
        }

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // send a message to the contact address with the form content
            $messageToContact = (new \Swift_Message())
                ->setSubject($subjectMail)
                ->setFrom($addressMail)
                ->setTo('contact.manabi@gmail.com')
                ->setBody($bodyMail);

            $mailer->send($messageToContact);

            // send a confirmation email to the user to tell him/her that they contact us
            $messageToUser = (new \Swift_Message())
                ->setSubject('Vous avez contacté Manabi')
                ->setFrom('contact.manabi@gmail.com')
                ->setTo($addressMail)
                ->setBody('
                    Bien le bonjour à toi,
    
                    Tu as récemment cherché à nous joindre via le formulaire de contact. Nous avons bien reçu ta demande et prendrons le temps de te répondre dans les plus brefs délais !
                    
                    Nous restons à ta disposition ;) 
                    
                    L’équipe Manabi.
                ');

            $mailer->send($messageToUser);
        }

        return $this->render('contact/contact.html.twig', [
            'form'            => $form->createView()
        ]);
    }
}
