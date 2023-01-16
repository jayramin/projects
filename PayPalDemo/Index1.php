<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<form id = "paypal_checkout" action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post">
    <input name = "cmd" value = "_cart" type = "hidden"><!-- for more then one items -->
    <input name = "upload" value = "1" type = "hidden">
    <input name = "no_note" value = "0" type = "hidden">
    <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
    <input name = "tax" value = "0" type = "hidden">
    <input name = "rm" value = "2" type = "hidden">

    <input name = "business" value = "arpit.icreate-facilitator@gmail.com" type = "hidden">
    <input name = "handling_cart" value = "0" type = "hidden">
    <input name = "currency_code" value = "USD" type = "hidden">
    <input name = "lc" value = "GB" type = "hidden">
    <input name = "return" value = "http://localhost:82/PayPalDemo/Succes.php" type = "hidden"><!-- after succesfulll transaction -->
    <input name = "cbt" value = "Return to My Site" type = "hidden">
    <input name = "cancel_return" value = "http://localhost:82/PayPalDemo/Cancel.php" type = "hidden"><!-- cancel transaction  -->
    <input name = "custom" value = "" type = "hidden">
 
    <div id = "item_1" class = "itemwrap">
        <input name = "item_name_1" value = "Gold Tickets" type = "hidden"><!-- 1st item  details  -->
        <input name = "quantity_1" value = "4" type = "hidden">
        <input name = "amount_1" value = "30" type = "hidden">
        <input name = "shipping_1" value = "0" type = "hidden">
    </div>
    <div id = "item_2" class = "itemwrap">
        <input name = "item_name_2" value = "Silver Tickets" type = "hidden"><!--  2nd item  details  -->
        <input name = "quantity_2" value = "2" type = "hidden">
        <input name = "amount_2" value = "20" type = "hidden">
        <input name = "shipping_2" value = "0" type = "hidden">
    </div>
    <div id = "item_3" class = "itemwrap">
        <input name = "item_name_3" value = "Bronze Tickets" type = "hidden"><!-- 3rd item  details  -->
        <input name = "quantity_3" value = "2" type = "hidden">
        <input name = "amount_3" value = "15" type = "hidden">
        <input name = "shipping_3" value = "0" type = "hidden">
    </div>
 
    <input id = "ppcheckoutbtn" value = "Checkout" class = "button" type = "submit">
</form>
