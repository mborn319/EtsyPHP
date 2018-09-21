<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;

class ProductsController extends AbstractController
{
  
  /**
   * @Route("/products/list", name="productsList")
   */
  public function list()
  {

    $client = new Client([
      'base_uri'  =>  'https://openapi.etsy.com/'
    ]);

    $url = getenv('ETSY_API_VERSION') . '/shops/' . getenv('ETSY_SHOP_NAME') . '/listings/active';
    $response = $client->get($url);

    if ( $response->getStatusCode() === "200" ) {
      $error = 'ERROR ' . $response->getStatusCode(); 
      return $this->render('error.html.twig', array('error' => $error ) );
    } else {
      return $this->render('listing.html.twig', array('listings' => json_decode( $response->getBody()->getContents() ) ) );
    }
  }

  /**
   * @Route("/products/tag/{tag}", name="productsByTag")
   */
  public function tag($tag)
  {
    
    $client = new Client([
      'base_uri'  =>  'https://openapi.etsy.com/'
    ]);

    $url = getenv('ETSY_API_VERSION') . '/shops/' . getenv('ETSY_SHOP_NAME') . '/listings/active';
    $response = $client->get($url, [
      'query' => [
        'api_key' => getenv('ETSY_API_KEY'),
        'tags' => array( $tag )
      ]
    ]);

    if ( $response->getStatusCode() === "200" ) {
      $error = 'ERROR ' . $response->getStatusCode(); 
      return $this->render('error.html.twig', array('error' => $error ) );
    } else {
      $data = array(
        'listings' => json_decode( $response->getBody()->getContents() )
      );
      return $this->render('listing.html.twig', $data);
    }
  }
}
