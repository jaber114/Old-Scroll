<?php
if(!empty($_SESSION["shopping_cart"]))
{
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        unset($_SESSION["shopping_cart"][$keys]);
    }
}
?>