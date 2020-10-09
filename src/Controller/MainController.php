<?php
// src/Controller/MainController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends AbstractController
{

/**  
*  @Route("/", name="home")
*/
    public function home()
    {
     
      $testy = "Hey";
      return $this->render('home/home.html.twig');
    
    }
}