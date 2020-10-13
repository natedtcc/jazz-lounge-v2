<?php
// src/Controller/MainController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class MainController extends AbstractController
{


/**  
*@Route("/", name="home")
*/
    public function home(AuthenticationUtils $auth): Response
    {
    

    if ($this->getUser()){
      $creds = $auth->getLastUsername(); 
      return $this->render(
        'home/home.html.twig', ['creds' => $creds]);
      }
    
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
*@Route("/cart", name="cart")
*/
  public function cart()
{
  return $this->render('cart/cart.html.twig');

}

/**
 * @Route("/logout", name="logout")
 */
public function logout(Request $request)
{
    return $this->render("home/home.html.twig");
}
};