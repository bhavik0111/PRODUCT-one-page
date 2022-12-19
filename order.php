<?php
  include("connect.php");
  $action = ''; 
 
?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>&#128526; Order Form </title>

            </head>

            <body>
                <form method="POST" action="order.php?action=Add">
                    <table border="1" align="center" cellpadding="15" cellspacing="0">

                        <tr>
                            <th colspan="2">
                                <h2>Order </h2>
                            </th>
                        </tr>

                            <!-- <div class="" align="right">
                                <a href="order.php?action=Add" class="btn btn-outline-success">Add+</a>
                            </div> -->

                        <tr>
                            <th>Order_Number</th>
                            <td><input type="text" name="Order_Number">

                            </td>
                        </tr>
                        
                        <tr>
                            <th>Date</th>
                            <td><input type="date" name="Date" >
                            </td>
                        </tr>

                        <tr>
                            <th>Customer_Name</th>
                            <td><input type="text" name="Customer_Name" >
                               
                            </td>
                        </tr>

                         <tr>
                            <th>Address</th>
                            <td><textarea name="Address" ></textarea></td>
                               
                            </td>
                        </tr>


                        <tr>
                            <th>Phone</th>
                            <td><input type="number" name="Phone" >

                                
                            </td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="Email">

                            </td>
                        </tr>

                         <tr>
                            <th>Shipping_Address</th>
                            <td><textarea name="Shipping_Address" ></textarea></td>
                               
                            </td>
                        </tr>

                       

                    </table>

                   <?php
                            
                                    $sql = "SELECT * FROM `product_master`";
                                    $result = mysqli_query($conn, $sql);    
                                    
                            ?>
                        <table border="1" align="center" cellpadding="15" cellspacing="0" style="margin-top:5px;">
                        <tr style="text-align:left;min-width:50">
                            <th>Product_name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <tr class="tr">
                                <td><select name="Product_name" class="Product_name">
                                    <option value="0">--select--</option>
                                        <?php
                                            if ($result->num_rows > 0) 
                                            {
                                                while ($row = $result->fetch_assoc()) 
                                                {
                                                ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php 
                                                }
                                            }    
                                        ?>
                                    </select>
                                </td>
                            <td><input type="text" name="Price" class="Product_price"></td>
                            <td><input type="text" name="Qty" ></td>
                            <td><input type="text" name="Discount"></td>
                            <td><input type="text" name="Total"></td>
                            <td><button type="button" id="AddProduct">Add</button></td>

                        </tr>
                        <tr>
                            <td colspan="6" align="center">
                                <input type="submit" name="submit">
                                <input type="reset" name="clear" value="clear">
                            </td>
                        </tr>
                    </table>

                </form>

                <script src="./script.js"></script>
                <script>
                     
                     $('#AddProduct').on('click', function(){
                       var html = '<tr><td><select name="Product_name" class="Product_name"><option value="0">--select--</option>'+
                       '<option value="<?php echo '1';?>">'+
                       '<?php echo 'hjkb'; ?></option>'+
                        '</select></td><td><input type="text" name="Price" class="Product_price"></td>'+
                        '<td><input type="text" name="Qty" ></td><td><input type="text" name="Discount"></td><td><input type="text" name="Total"></td><td><a class="DeleteProduct">Delete</a></td></tr>';
                        console.log(html);
                                 $('.tr').last().after(html);
                     });

                    $('.Product_name').on('change',function(){
                        var product_id = $(this).val();
                        var price_input = $(this).closest('td').siblings().find('.Product_price');
                        console.log(price_input);
                        $.ajax({
                            type: 'POST',
                            url: './getProductPrice.php',
                            data: {'product_id':product_id}
                        })
                        .done(function(response) {
                            // demonstrate the response
                            if(response.length) {
                                var html  = '';
                                var res = $.parseJSON(response);
                                price_input.val(res.price);
                            }
                        })
                        .fail(function() {
                            // if posting your form failed
                            alert("Posting failed.");
                        });
                    });
                </script>
            </body>
        </html>
<?php
 if(isset($_REQUEST["submit"]))
  {
        $Order_Number  = $_REQUEST["Order_Number"];
        $Date          = $_REQUEST["Date"];
        $Customer_Name = $_REQUEST["Customer_Name"];
        $Address       = $_REQUEST["Address"];
        $Phone         = $_REQUEST["Phone"];
        $Email         = $_REQUEST["Email"];
        $Shipping_Address = $_REQUEST["Shipping_Address"];
      
        $query ="INSERT INTO `order_master` VALUES ('','$Order_Number', '$Date', '$Customer_Name', '$Address', '$Phone', '$Email', '$Shipping_Address')"; 

        $result=mysqli_query($conn, $query);
           

   if($result)
   {
    echo "<h3> Data inserted into Database successfully </h3>";
    header("refresh:3");
   }
   else
   {
    echo "<h4> failed in database </h4>";
   }
  }
  ?>


          
