<?php
// src/Controller/HomeController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

/**  
*@Route("/", name="home")
*/
  public function home()
  {
    return $this->render('home/home.html.twig');
  }
};