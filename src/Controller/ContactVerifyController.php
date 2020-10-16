<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactVerifyController extends AbstractController
{
    /**
     * @Route("/contact/verify", name="contact_verify")
     */
    public function index()
    {
        return $this->render('contact_verify/index.html.twig', [
            'controller_name' => 'ContactVerifyController',
        ]);
    }
}
