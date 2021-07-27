<?php
// src/Services/CarouselService.php

namespace App\Services;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class CarouselService extends AbstractController{

  private $em;
  private $product;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function getAllCarouselItems()
{
   $products = $this->getDoctrine()
  ->getRepository(Products::class)
  ->findAll();
  return $products;

}

  public function getCarouselItemsByCategory(string $category)
{
   $products = $this->getDoctrine()
  ->getRepository(Products::class)
  ->findBy(['category' => $category]);
  return $products;

}

}