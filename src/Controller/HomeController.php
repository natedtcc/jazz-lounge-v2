<?php
// src/Controller/HomeController.php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

/**  
*@Route("/", name="home")
*/
  public function home()
  {
    $products = $this->getDoctrine()
    ->getRepository(Products::class)
    ->findAllRandomly();
    return $this->render(
      'home/home.html.twig', ['carousel' => $products]
    );
  }
};