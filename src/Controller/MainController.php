<?php
// src/Controller/MainController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{

/**  
*@Route("/", name="home")
*/
    public function home()
    {
      return $this->render('home/home.html.twig');
    }

/**
*@Route("/browse/", name="browse")
*/   
    public function browse(
      EntityManagerInterface $em, PaginatorInterface $paginator,
       Request $request)
    {
      $sql_str = "SELECT a FROM App\Entity\Products a";
      $query = $em->createQuery($sql_str);
      
      $pagination = $paginator->paginate(
        $query, $request->query->getInt('page', 1), 10
      );
      return $this->render(
        'browse/browse.html.twig', ['pagination' => $pagination]
      );
    }
}