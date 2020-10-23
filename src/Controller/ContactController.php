<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {

        $message = new ContactForm();

        $form = $this->createForm(ContactFormType::class, $message);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $message = [
                'message' => "Your message has been sent! Please allow us 1-2 business days to respond.",
                'type' => "custom_alert alert-success"
            ];
            $this->redirect('home');
            return $this->render('/home/home.html.twig', ['message', $message]);
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $message = [
                'message' => "There was an error sending your message. Please try again.",
                'type' => "custom_alert alert-danger"
            ];

            return $this->redirectToRoute('home', ['message' => $message]);
        }

        return $user ?
            $this->render(
                'contact/contact.html.twig',
                ['user' => $user, 'form' => $form->createView()]
            ) :
            $this->render(
                'contact/contact.html.twig',
                ['form' => $form->createView()]
            );
    }
}