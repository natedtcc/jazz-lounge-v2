<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AddCartController extends AbstractController
{
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

}
