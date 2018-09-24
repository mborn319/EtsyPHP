<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;

class ListingController extends ApiController
{
  
  /**
   */
  public function findAllShopListingsActive( array $args ) {
    $defaults = array( 
      'limit' => 25,
      'offset' => 0,
      'page' => 1,
      'shop_id' => '',
      'sort_on' => 'created',
      'sort_order' => 'down',
      'tags' => '',
      'category' => '',
      'translate_keywords' => false,
      'include_private' => false
    );
    $api_args = array_merge( $defaults, $args );
    $api_args['api_key'] = getenv('ETSY_API_KEY');
    
    $client = new Client([
      'base_uri'  =>  'https://openapi.etsy.com/'
    ]);

    $url = getenv('ETSY_API_VERSION') . '/shops/' . $args['shop_id'] . '/listings/active';
    
    return $client->get($url, [
      'query'   => $api_args
      ]
    );
  }
}
