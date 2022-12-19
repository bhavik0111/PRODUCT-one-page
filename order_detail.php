
            <!DOCTYPE html>
            <html>

            <head>
                <title>&#128526; Order detail Form </title>

            </head>

           
            <body>
                <form method="POST" action="product.php?action=Add" enctype="multipart/form-data">
                    <table border="1" align="center" cellpadding="15" cellspacing="0">

                        <tr>
                            <th colspan="2">
                                <h2>Order detail </h2>
                            </th>
                        </tr>

                        <tr>
                            <th>Order_id</th>
                            <td><input type="text" name="Order_id" >

                            </td>
                        </tr>
                        

                        <tr>
                            <th>Product_id</th>
                            <td><input type="text" name="Product_id"
                            </td>
                        </tr>



                        <tr>
                            <th>Qty</th>
                            <td><input type="text" name="Qty" >
                               
                            </td>
                        </tr>


                        <tr>
                            <th>Price</th>
                            <td><input type="nuber" name="Price" >

                               
                            </td>
                        </tr>

                        <tr>
                            <th>Discount</th>
                            <td><input type="number" name="Discount" >
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="submit">
                                <input type="reset" name="clear" value="clear">
                            </td>
                        </tr>
                    </table>
                </form>
            </body>
            </html>
