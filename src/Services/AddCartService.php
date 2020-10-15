<?php
// src/Services/AddCartService.php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddCartService extends AbstractController{

  private $em;
  private $product;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

    public function addCart($request)
{
  /* If the user is not logged in, redirect them to login */

  if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')){
    return $this->redirect('login');
  }

  /* Get product ID from request, create query based on product
  ID, get the results */

  $pid = $request->query->getInt('pid');
  
  $this->product = $this->em->createQuery(
    "SELECT a FROM App\Entity\Products a WHERE a.product_id = ".$pid
    ) ->getResult();


  if (!$this->product) {
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
    $val[$pid] = ['title' => $this->product[0]->getTitle(),
      'artist' => $this->product[0]->getArtist(),'price' => $this->product[0]->getPrice(), 
        'image' => $this->product[0]->getImage(), 'quantity' => 1];
  }
  
  /* Apply changes to cart session array */

  $this->get('session')->set('cart', $val);

}

}