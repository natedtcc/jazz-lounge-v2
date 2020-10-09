<?php
// src/Controller/MainController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

/**  
*  @Route("/", name="home")
*/
    public function home()
    {
      $test = "Hey";
      return $this->render('home/home.html.twig');
    
    }
}