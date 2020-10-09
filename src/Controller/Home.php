<?php
// src/Controller/Home.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

include("header.html");

class Home
{

/**  
*  @Route("/home")
*/
    public function number(): Response
    {
        return new Response(
            '<body><h3 class="display-3 text-center">
            Welcome to the Jazz Emporium!
          </h3>
          <table class="center">
            <tr>
              <td>
                <p class="lead">
          
                Here you will find some of the best Jazz albums of all time for 
                sale. These are not CDs, digital downloads or any other type of 
                digital media, they are vinyl records. They are reprints of 
                original albums released years ago that, in some cases, were 
                out of print for decades. Now, amongst the rising resurgance of 
                popularity in vinyl albums, they are being reproduced for all to 
                enjoy.<br>Check out our catalog!
                
                </p>
              </td>
            </tr>
          </table></body>'
        );
    }
}