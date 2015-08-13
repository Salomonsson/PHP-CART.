# PHP-CART.

Object Instantiate

$cart = new CCart($db);
 
$cartSession = isset($_SESSION['custumer_cart']) ? $_SESSION['custumer_cart'] : null;



  $cart->RemoveItemFromCart();
  $cart->RenderCart($cart->AddToCart())

if (emptyCart) {
   unset($_SESSION['custumer_cart']);
     #unset($_SESSION['custumer_cart'][$removeItem]);
     $cartSession = null;
}
