<?php

namespace Sample;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
require 'paypal-client.php';
$orderID=$_GET['orderID'];

class GetOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {

    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));

    //transaction details
    $orderID= $response->result->id;
    $email = $response->result->payer->email_address;
    $name = $response->result->purchase_units[0]->shipping->name->full_name;
    $address1 = $response->result->purchase_units[0]->shipping->address->address_line_1;
    $address2 = $response->result->purchase_units[0]->shipping->address->admin_area_2;
    $address3 = $response->result->purchase_units[0]->shipping->address->admin_area_1;
    $address4 = $response->result->purchase_units[0]->shipping->address->postal_code;
    $address5 = $response->result->purchase_units[0]->shipping->address->country_code;
    $FullAddress= $address1.",".$address4."&nbsp".$address2.",".$address3.",".$address5;

    //include details to our database
    include('sessionTop.php');

    $payment="INSERT INTO payments (name, email, orderID, address) VALUE ('$name','$email','$orderID','$FullAddress')";
    $runPay=$conn->query($payment) or die($conn->error.__LINE__);

    if($runPay == false){
        echo "There was a problem on your code".mysqli_error($conn);
    }else{
        header("Location:Home.php");
    }
  }
}

if (!count(debug_backtrace()))
{
  GetOrder::getOrder($orderID, true);
}
?>