<?php
// ./src/Controller/RegistrationController
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Services\CarouselService;
use App\Services\GenerateToastService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {
    $this->passwordEncoder = $passwordEncoder;
  }



/**
*@Route("/register", name="register")
*/
  public function index(
    Request $request, 
    GenerateToastService $generateToastService,
    CarouselService $carouselService
    )
  {
    $user = new User();

    $form = $this->createForm(UserType::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted()){
      
      if($this->isDuplicateUser($user)){
        $toast = $generateToastService->
          generateErrorToast("That email address is already registered!");
        
        return $this->render('security/register.html.twig', 
          ['form' => $form->createView(), 'toast' => $toast]
        );
      }
      
      elseif(!$user->getPassword()){
        $toast = $generateToastService->
          generateErrorToast("Your passwords do not match!");

        return $this->render('security/register.html.twig', 
          ['form' => $form->createView(), 'toast' => $toast]
        );
      }
      
      elseif (!$form->isValid())  {
        $toast = $generateToastService->
          generateErrorToast("There was an error with your information. Please try again.");

        return $this->render('security/register.html.twig', [
          'form' => $form->createView(), 'toast' => $toast
          ]);
        }

      else { // Add a new user
      // Encode the new users password
      $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

      // Set their role
      $user->setRoles(['ROLE_USER']);

      // Save
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      
      $carousel = $carouselService->getCarouselItems();

      return $this->redirectToRoute('login', 
        ['carousel' => $carousel]
      );
    }
  }
  return $this->render('security/register.html.twig', [
    'form' => $form->createView(),
  ]);
}

  // Ensure duplicate emails are not created
  private function isDuplicateUser(User $user){
    return (boolean)  $this->getDoctrine()
    ->getRepository(User::class)
    ->findOneBy(array('email' => $user->getEmail()));

  }
}