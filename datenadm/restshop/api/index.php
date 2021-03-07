<?php

require '../vendor/autoload.php';
require '../src/config/db.php';

//require '../../../bookstore-stripe-checkout/stripe-php-master/init.php';

$app = new \Slim\App;

// Bookshop Routes
require '../src/routes/books.php';
//require 'stripe_redirect.php';

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys

$app->run();

?>

