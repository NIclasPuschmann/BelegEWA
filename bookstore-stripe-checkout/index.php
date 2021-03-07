<?php
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys

require 'stripe-php-master/init.php';
//include 'books.php';

require '../datenadm/restshop/vendor/autoload.php';
require '../datenadm/restshop/src/config/db.php';
//require '../datenadm/restshop/src/routes/books.php';

use Slim\Http\Request;
use Slim\Http\Response;
use Stripe\Stripe;

$app = new \Slim\App;

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys

// $bookId = $_GET['bookId'];

$public_key_for_js = "???";

$app->add(function ($request, $response, $next) {
  // Set your secret key. Remember to switch to your live secret key in production!
  // See your keys here: https://dashboard.stripe.com/account/apikeys
 \Stripe\Stripe::setApiKey('sk_test_cFnCai0Ye9NM8Tn9CMo6k0fn00P0R9pt9u');

  return $next($request, $response);
});



$app->post('/create-checkout-session', function (Request $request, Response $response) {
  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    //'line_items' => [$books[$bookId]],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'T-shirt',
        ],
        'unit_amount' => 2000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://iws107.informatik.htw-dresden.de/ewa/G16/bookstore-stripe-checkout/' . 'success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'https://iws107.informatik.htw-dresden.de/ewa/G16/bookstore-stripe-checkout/' . 'cancel.php',
  ]);
  
   return $response->withJson([ 'id' => $session->id ])->withStatus(200);
});

$app->run();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

  <h1>Bookstore</h1>

  Sie werden zum Stripe-Checkout weitergeleitet....

  <script>
    // var stripe = Stripe('<php echo $public_key_for_js ?>');
    // stripe.redirectToCheckout({
    //   //fragenzeichen wieder einsetzen  
      
    //   sessionId: '<php echo $session['id']; ?>'  

    //   //sessionId : session.id

    // }).then(function(result) {

    // });
  </script>

</body>

</html>