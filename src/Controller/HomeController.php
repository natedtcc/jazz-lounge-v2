<?php
// src/Controller/HomeController.php

namespace App\Controller;

use App\Services\CarouselService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

/**  
*@Route("/", name="home")
*/
  public function home(CarouselService $carouselService)
  {
    $categories = ["Bebop", "Fusion", "Swing", "Modal"];
    if ($categories){
      $carousel = [];
      for ($i=0; $i<count($categories); $i++){
        $carousel += 
          [strtolower($categories[$i]) => $carouselService->getCarouselItemsByCategory($categories[$i])];
      }
    }
    //   $category = "Bebop";
    // if ($category){
    //  $carousel = $carouselService->getCarouselItemsByCategory($category);
    // }
    
    else {
      $carousel = $carouselService->getAllCarouselItems();
      
    }

    return $this->render(
      'home/home.html.twig', ['carousel' => $carousel]
    );
  }
};