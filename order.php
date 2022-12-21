<?php
  include("connect.php");

session_start();

    $action = ''; 


    $Order_Number = '';
    $Customer_Name = '';
    $Email = '';

 if(isset($_POST["submit"]))
  {
        $Order_Number = $_POST["Order_Number"];  //..............................
        
            if (empty($_POST['Order_Number'])) 
            {
              $_SESSION['error']['Order_Number_error'] = "Please enter Order_Number";
            }

        $Date = $_POST["Date"];                   //.................................
            
            if (empty($_POST['Date'])) 
            {
              $_SESSION['error']['Date_error'] = "Please enter Date";
            }

        $Customer_Name = $_POST["Customer_Name"];  //.................................

            if (empty($_POST['Customer_Name'])) 
            {
              $_SESSION['error']['Customer_Name_error'] = "Please enter Customer_Name";
            }

        $Address = $_POST["Address"];       //...............................

            if (empty($_POST['Address'])) 
            {
              $_SESSION['error']['Address_error'] = "Please enter Address";
            }

        $Phone = $_POST["Phone"];         //.............................

            if (empty($_POST['Phone'])) 
            {
              $_SESSION['error']['Phone_error'] = "Please enter Phone";
            }
   
        $Email = $_POST["Email"];      //.............................
 
            if (empty($_POST['Email'])) 
            {
              $_SESSION['error']['Email_error'] = "Please enter Email";
            }

        $Shipping_Address = $_POST["Shipping_Address"];  //.............................

             if (empty($_POST['Shipping_Address'])) 
            {
              $_SESSION['error']['Shipping_Address_error'] = "Please enter Shipping_Address";
            }






        $query ="INSERT INTO `order_master` VALUES ('','$Order_Number', '$Date', '$Customer_Name', '$Address', '$Phone', '$Email', '$Shipping_Address')"; 

        $result=mysqli_query($conn, $query);



            $last_id = $conn->insert_id;    

            foreach ( $_POST['Product_name'] as $key => $value) 
            {
                $value_query = mysqli_query($conn, "INSERT INTO `order_products` (Order_Details_id, Order_id, Product_id, Price, Discount, Qty, Total) VALUES ('".$last_id."','','".$_POST['Product_name'][$key]."', '".$_POST['Price'][$key]."','".$_POST['Discount'][$key]."', '".$_POST['Qty'][$key]."', '".$_POST['Total'][$key]."')");
            }

            /*
            $order_id = mysqli_insert_id($result);
            Product_name{
                $query ="INSERT INTO `order_products` VALUES ('','$Order_id', '$Product_id', '$Qty', '$Price', '$Discount')";     
            }*/
            
                   
                

                if (!isset($_SESSION['error'])) 
                {
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
}
?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>&#128526; Order Form </title>

            </head>

            <body>
                <form method="POST" >
                    <table border="1" align="center" cellpadding="15" cellspacing="0" >

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
                            <td><input type="text" name="Order_Number" value="<?php echo $Order_Number; ?>">
                                <span style="color:red"><?php if (isset($_SESSION['error']['Order_Number_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Order_Number_error'];
                                                                 unset($_SESSION['error']['Order_Number_error']);
                                                               } ?></span>

                            </td>
                        </tr>
                        
                        <tr>
                            <th>Date</th>
                            <td><input type="date" name="Date" value="<?php echo $Date; ?>">
                                 <span style="color:red"><?php if (isset($_SESSION['error']['Date_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Date_error'];
                                                                 unset($_SESSION['error']['Date_error']);
                                                               } ?></span>
                            </td>
                        </tr>

                        <tr>
                            <th>Customer_Name</th>
                            <td><input type="text" name="Customer_Name" value="<?php echo $Customer_Name; ?>">
                                <span style="color:red"><?php if (isset($_SESSION['error']['Customer_Name_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Customer_Name_error'];
                                                                 unset($_SESSION['error']['Customer_Name_error']);
                                                               } ?></span>
                               
                            </td>
                        </tr>

                         <tr>
                            <th>Address</th>
                            <td><textarea name="Address" value="<?php echo $Address; ?>"></textarea>
                                  <span style="color:red"><?php if (isset($_SESSION['error']['Address_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Address_error'];
                                                                 unset($_SESSION['error']['Address_error']);
                                                               } ?></span>
                               
                            </td>
                        </tr>


                        <tr>
                            <th>Phone</th>
                            <td><input type="number" name="Phone" value="<?php echo $Phone; ?>">
                                <span style="color:red"><?php if (isset($_SESSION['error']['Phone_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Phone_error'];
                                                                 unset($_SESSION['error']['Phone_error']);
                                                               } ?></span>

                                
                            </td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="Email" value="<?php echo $Email; ?>">
                                <span style="color:red"><?php if (isset($_SESSION['error']['Email_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Email_error'];
                                                                 unset($_SESSION['error']['Email_error']);
                                                               } ?></span> 

                            </td>
                        </tr>


                         <tr>
                            <th>Shipping_Address</th>
                            <td><textarea name="Shipping_Address" value="<?php echo $Shipping_Address; ?>"></textarea>
                                <span style="color:red"><?php if (isset($_SESSION['error']['Shipping_Address_error'])) 
                                                               {
                                                                 echo '<br>' . $_SESSION['error']['Shipping_Address_error'];
                                                                 unset($_SESSION['error']['Shipping_Address_error']);
                                                               } ?></span>  

                            </td>
                        </tr>              
                    </table>

                   <?php

unset($_SESSION['error']);
                            
                                    $sql = "SELECT * FROM `product_master`";
                                    $result = mysqli_query($conn, $sql);    
                                    
                            ?>
                        <table border="1" align="center" cellpadding="15" cellspacing="0" style="margin-top:30px;">

                        <tr style="text-align:left;min-width:50">
                            <th>Product_name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                        <tr class="tr">
                                <td><select name="Product_name[]" class="Product_name">
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
                            
                            <td><input type="text" name="Price[]" class="Product_price"></td>
                            
                            <td><input type="text" name="Discount[]"></td>
                            
                            <td><input type="text" name="Qty[]" ></td>
                            
                            <td><input type="text" name="Total[]"></td>

                            <td><button type="button" id="AddProduct">Add++</button></td>
                        </tr>

                        <tr>
                            <td colspan="6" align="center">
                                <input type="submit" name="submit">
                                <input type="reset" name="clear" value="clear">
                            </td>
                        </tr>

                    </table>

                </form>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>

              <script>

             // GET Price frome Product_name.......................................................................

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


             // AD++................................................................................

                    $('#AddProduct').on('click', function()
                    {
                        <?php
                                $sql = "SELECT * FROM `product_master`";
                                $result = mysqli_query($conn, $sql);                            
                             ?>

                       var html = '<tr><td><select name="Product_name[]" class="Product_name"><option value="0">--select--</option>'+
                                        <?php
                                            if ($result->num_rows > 0) 
                                            {
                                                while ($row = $result->fetch_assoc()) 
                                                {
                                                ?>
                       '<option value="<?php echo $row['id'];?>">'+
                       '<?php echo $row['name']; ?></option>'+
                                               <?php 
                                                }
                                            }    
                                        ?>
                        '</select></td><td><input type="text" name="Price" class="Product_price"></td>'+
                        '<td><input type="text" name="Qty[]" ></td><td><input type="text" name="Discount[]"></td><td><input type="text" name="Total"></td><td><a class="DeleteProduct">Delete</a></td></tr>';
                        console.log(html);
                        $('.tr').last().after(html);


             // Add++ product & GET Price frome Product_name.......................................................................
                          
                        $('.Product_name').on('change',function()
                        {
                            var product_id = $(this).val();
                            var price_input = $(this).closest('td').siblings().find('.Product_price');
                            console.log(price_input);
                            
                            $.ajax({
                                    type: 'POST',
                                    url: './getProductPrice.php',
                                    data: {'product_id':product_id}
                                  })

                            .done(function(response) 
                                {
                                    // demonstrate the response
                                    if(response.length) 
                                     {
                                       var html  = '';
                                       var res = $.parseJSON(response);
                                       price_input.val(res.price);
                                     }
                                })

                            .fail(function() 
                            {  
                                // if posting your form failed
                                 alert("Posting failed.");
                            });
                        });
                    });
                </script>
            </body>
        </html>



          
