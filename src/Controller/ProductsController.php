<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ProductsController
{
  public function list()
  {
    return new Response(
      '<html><body>TEST</body></html>'
    );
  }
}
