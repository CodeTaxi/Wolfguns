<?php
use Bigcommerce\Api\Client as Bigcommerce;
use Bigcommerce\Api\Error as Error;

// load requirements:
require_once '../autoload.php';

/* big commerce: */
Bigcommerce::configure($config['big_commerce']);
Bigcommerce::setCipher('RC4-SHA');
Bigcommerce::verifyPeer(false);
Bigcommerce::failOnError();

try {
    // list categories:
    /*
    $r = Bigcommerce::getCategories();
    foreach($r as $c) {
        echo $c->id.' '.$c->name."\n";
    }
    exit;
    */

    $data = array(
        'name' => 'some test product',
        'price' => '0.99',
        'categories' => 1,
        'type' => 'physical',
        'upc' => null,
    );
    //$product = array('name' => 'ABC Blocks', 'type' => 'physical', 'price' => '19.99', 'weight' => 2.3, 'categories' => array(34), 'availability' => 'available', 'is_visible' => true);
    Bigcommerce::createProduct($data);
    /*$r = Bigcommerce::getStore();

    foreach ($r as $c) {
        echo $c->id . ' ' . $c->name . "\n";
    }*/
} catch (Error $e) {
    echo $e->getCode() . ' :' . $e->getMessage() . "\n";
}
