<?php
// src/Controller/MainController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
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
*@Route("/browse", name="browse")
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

/**  
*@Route("/add_cart", name="add_cart")
*/
  public function cart(Request $request)
  {
    /* Get product ID from request and add them
    to the cart array within the user session */
    
    $cart = $request->query->getInt('pid');
    $val = $this->get('session')->get('cart');
    $val[] = $cart;
    $this->get('session')->set('cart', $val);
    return $this->redirect('browse');

  }

/**  
*@Route("/view_cart", name="view_cart")
*/
  public function view_cart(Request $request)
  {
    $cart = $this->get('session')->get('cart');
    // $value = $session[1];
    return $this->render('cart/cart.html.twig', ['cart' => $cart]);
  }
};