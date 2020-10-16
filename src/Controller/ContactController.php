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

        $form = $this->createForm(UserType::class, $message);

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        
        ]);
    }
}
