<?php
// src/Controller/ProductsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;
use App\Controller\ListingController;

class ProductsController extends AbstractController
{
  
  /**
   * @Route("/products/list", name="productsList")
   * @Route("/products/list/{page}", name="productsListByPage")
   */
  public function list($page = 1) {
		$etsyAPI = new ListingController();

		$response = $etsyAPI->findAllShopListingsActive( array(
			'page' => $page,
			'shop_id' => getenv('ETSY_SHOP_NAME')
		) );

    if ( $response->getStatusCode() === "200" ) {
      $error = 'ERROR ' . $response->getStatusCode(); 
      return $this->render('error.html.twig', array('error' => $error ) );
    } else {
      return $this->render('listing.html.twig', array('listings' => json_decode( $response->getBody()->getContents() ) ) );
    }
  }

  /**
   * @Route("/products/tag/{tag}", name="productsByTag")
   * @Route("/products/tag/{tag}/{page}", name="productsByTag")
   */
  public function tag($tag, $page = 1)
  {
		$etsyAPI = new ListingController();
		$response = $etsyAPI->findAllShopListingsActive( array(
			'tags' => $tag,
			'page' => $page,
			'shop_id' => getenv('ETSY_SHOP_NAME')
		) );
    

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
