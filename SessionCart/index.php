<?php
include 'controller.php';
?>
<html>
    <head></head>
    <body>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Product Code</td>
                    <td><input type="text" name="ProductCode"></td>
                </tr>
                <tr>
                    <td>Product Name</td>
                    <td><input type="text" name="ProductName"></td>
                </tr>
                <tr>
                    <td>Product Price</td>
                    <td><input type="text" name="ProductPrice"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Add To Cart" name="SaveCart"></td>
                </tr>
            </table>
        </form>
    </body>
</html>