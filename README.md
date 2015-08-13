# PHP-CART.

Object Instantiate

//If database
#$cart = new CCart($db);

#$cart = new CCart();
 
$cartSession = isset($_SESSION['custumer_cart']) ? $_SESSION['custumer_cart'] : null;



  $cart->RemoveItemFromCart();
  $cart->RenderCart($cart->AddToCart())

if (emptyCart) {
   unset($_SESSION['custumer_cart']);
     #unset($_SESSION['custumer_cart'][$removeItem]);
     $cartSession = null;
}
