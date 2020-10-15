<?php
// src/Services/PaginationService.php

namespace App\Services;

use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;

    /**
   * PaginatorInterface represents a paginated request
   * to the database.
   * 
   * Method:
   * 
   * paginate()
   * 
   * @return Pagination
   */

class PaginationService{

  private $entity;
  private $paginator;

  public function __construct(
    EntityManagerInterface $entity, PaginatorInterface $paginator){
        $this->entity = $entity;
        $this->paginator = $paginator;
      }
    /**
   * Returns paginated results from a database
   *
   * @param Request $request
   * @return Pagination $pagination
   */

  public function paginate($request){
    /* Create product query for pagination */
    
    $sql_str = "SELECT a FROM App\Entity\Products a";
    $query = $this->entity->createQuery($sql_str);
    
    /* Create paginated results, then return them */

    $pagination = $this->paginator->paginate(
      $query, $request->query->getInt('page', 1), 10
    );

    return $pagination;
  }


}