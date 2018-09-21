<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

class ProductsController
{
  public function list()
  {

    $client = new Client([
      'base_uri'  => 'https://openapi.etsy.com/',
      'query'     => [ 'api_key' => getenv('ETSY_API_KEY') ]
    ]);

    $response = $client->request('GET',getenv('ETSY_API_VERSION') . '/shops/' . getenv('ETSY_SHOP_NAME') . '/listings/active');

    if ( $response->getStatusCode() === "200" ) {
      $error = 'ERROR ' . $response->getStatusCode(); 
      return new Response(
        '<p class="notification is-danger">' . $error. '</p>'
      );
    } else {
      return new Response(
        $response->getBody()->getContents()
      );
    }
  }
}
