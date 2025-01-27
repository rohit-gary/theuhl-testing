<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getOrCreateCart($session_id, $user_id)
{

    require_once('../../uhladmin/uhl-management/include/autoloader.inc.php');
    include("../../uhladmin/uhl-management/include/db-connection.php");
    $cart_id = null;
    $Cart_obj = new Cart($conn);
    $user_id = isset($_SESSION['dwd_UserID']) ? $_SESSION['dwd_UserID'] : null;
    if ($user_id) {

        $cart = $Cart_obj->GetcartItemByUserId($user_id);



        if ($cart && isset($cart['id'])) {
            $cart_id = $cart['id'];
        } else {

            $cart = $Cart_obj->InsertuserIdIntocart($user_id);


            if (isset($cart['last_insert_id'])) {
                $cart_id = $cart['last_insert_id'];
            } else {
                throw new Exception('Failed to create a cart for the user.');
            }
        }
    } else {

        $cart = $Cart_obj->GetcartItemBySessionId($session_id);




        if ($cart && isset($cart['id'])) {
            $cart_id = $cart['id'];
        } else {


            $cart = $Cart_obj->InsertsessionIdIntocart($session_id);


            if (isset($cart['last_insert_id'])) {
                $cart_id = $cart['last_insert_id'];
            } else {
                throw new Exception('Failed to create a cart for the session.');
            }
        }
    }



    return $cart_id;

}
?>