<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductOrder as Item;

class ProductOrderController extends APIController
{
  function __construct(){
    $this->model = new Item();
    $this->validation = array(
    );
    $this->defaultValue = array(
      'status' => 0,
      'rice_option' => 0,
      'barley_option' => 0,
      'basmati_option' => 0,
      'payment_method' => 1
    );
    $this->foreignTable = array(
      'product'
    );
    $this->validation = array(
      'email' => 'email'
    );
    $this->requiredForeignTable = array(
      'product'
    );
    $this->notRequired = array('rice_option', 'barley_option', 'basmati_option', 'status');
  }

  public function create(Request $request){
    $this->createEntry($request->all());
    if($this->response['data'] * 1){
      mail($request['email'],"FineGrabz Order Confirmation",
        'Good day '.$request['name']."\n\tPlease click the link below for confirmation. ".time().$this->response['data'].time(),
        "From: plenosjohn@yahoo.com");

    }
    $this->response["debug"][] = url('/path/uri');
    $this->response["debug"][] = (time().$this->response['data'].time()*1);
    return $this->output();
  }
  public function confirmOrder($confirmation_code){
    $this->updateEntry(array(
      'id' => substr(substr($confirmation_code, 10), 0, -10),
      'status' => 1
    ));
    echo "Order Confirmed";
  }
}
