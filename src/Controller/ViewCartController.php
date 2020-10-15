<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ViewCartController extends AbstractController
{
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
}
