<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BrowseController extends AbstractController
{
    /**
     * @Route("/browse", name="browse")
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
}
