<?php

namespace App\Controller;

use App\Services\GenerateToastService;
use App\Services\CarouselService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
  /**
   * @Route("/login", name="login")
   */
  public function login(
    AuthenticationUtils $authenticationUtils,
    GenerateToastService $generateToastService,
    CarouselService $carouselService ): Response
  {
    if ($this->getUser()) {
      $toast = $generateToastService->generateSuccessToast(
        "You have successfully logged in."
      );
      $carousel = $carouselService->getCarouselItems();
      return $this->render('security/login.html.twig',
        ['carousel' => $carousel, 'toast' => $toast]);
    }

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    if ($authenticationUtils->getLastAuthenticationError()){
      // get the login error if there is one
      $toast = $generateToastService->generateErrorToast(
        "Authentication error. Please check your credentials and try again.", "error");

      return $this->render('security/login.html.twig', 
      ['last_username' => $lastUsername, 'toast' => $toast]);
    }

    return $this->render('security/login.html.twig', 
      ['last_username' => $lastUsername]);
  }

  /**
   * @Route("/logout", name="logout")
   */
  public function logout()
  {
    throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
  }


}
