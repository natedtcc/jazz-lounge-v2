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
    /* Create product query for pagination */

    $sql_str = "SELECT a FROM App\Entity\Products a";
    $query = $em->createQuery($sql_str);
    
    /* Create paginated results, then return them */

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
  public function cart(Request $request, EntityManagerInterface $em)
  {
    /* If the user is not logged in, redirect them to login */

    if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')){
      return $this->redirect('login');
    }

    /* Get product ID from request, create query based on product
    ID, get the results */
    
    $pid = $request->query->getInt('pid');
    
    $product = $em->createQuery(
      "SELECT a FROM App\Entity\Products a WHERE a.product_id = ".$pid
      ) ->getResult();

  
    if (!$product) {
      throw $this->createNotFoundException(
          'No product found for product id '.$pid
      );
    }
    /* Get the current shopping cart contents from the session */  

    $val = $this->get('session')->get('cart');

    /* If the item added to the cart is already in the cart,
    increment the quantity. Otherwise, add the new item to
    the cart with the data pulled from the DB */
    
    if (isset($val[$pid])) $val[$pid]['quantity']++;
    
    else {
      $val[$pid] = ['title' => $product[0]->getTitle(),
        'artist' => $product[0]->getArtist(),'price' => $product[0]->getPrice(), 
          'image' => $product[0]->getImage(), 'quantity' => 1];
    }
    
    /* Apply changes to cart session array */

    $this->get('session')->set('cart', $val);
    return $this->redirect('view_cart');
  }

/**  
*@Route("/view_cart", name="view_cart")
*/
  public function view_cart(Request $request)
  {
    /* If the user is not logged in, redirect them to login */
    if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')){
      return $this->redirect('login');
    }

    /* Get contents of cart from session, and return cart 
    variable to cart.html.twig */

    $cart = $this->get('session')->get('cart');
    return $this->render('cart/cart.html.twig', ['cart' => $cart]);
  }
};