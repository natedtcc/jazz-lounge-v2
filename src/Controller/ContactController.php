<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        $message = new ContactForm();

        $form = $this->createForm(ContactFormType::class, $message);
        $user = $this->getUser();
        return $user ?
            $this->render('contact/contact.html.twig',
                ['user' => $user, 'form' => $form->createView()]) : 
            $this->render('contact/contact.html.twig',
                ['form' => $form->createView()]);

    }
}
