<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AddCartService;

class AddCartController extends AbstractController
{
/**  
*@Route("/add_cart", name="add_cart")
*/
public function cart(Request $request, AddCartService $cartService)
{
    $cartService->addCart($request);

    return $this->redirect('view_cart');
}

}
