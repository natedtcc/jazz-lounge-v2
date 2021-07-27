<?php
// src/Services/PaginationService.php

namespace App\Services;


class GenerateToastService 
{

  function generateSuccessToast(string $string){

    $toast = [
      'message' => $string,
      'type' => "custom_alert alert-success"
      ];

    return $toast;
  }


  function generateErrorToast(string $string){

    $toast = [
      'message' => $string,
      'type' => "custom_alert alert-danger"
    ];

    return $toast;
  }

  function generateWarningToast(string $string){

    $toast = [
      'message' => $string,
      'type' => "custom_alert alert-warning"
    ];

    return $toast;
  }


}