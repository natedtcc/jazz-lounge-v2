<?php

namespace App\Controller;

use App\Services\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BrowseController extends AbstractController
{
    /**
     * @Route("/browse", name="browse")
     */
    public function browse(PaginationService $paginationService, Request $request)
      {
        $pagination = $paginationService->paginate($request);
        
        return $this->render(
          'browse/browse.html.twig', ['pagination' => $pagination]
        );
      }
}
