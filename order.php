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

                            <div class="" align="right">
                                <a href="order.php?action=Add" class="btn btn-outline-success">Add+</a>
                            </div>

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

                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="submit">
                                <input type="reset" name="clear" value="clear">
                            </td>
                        </tr>

                    </table>

                   <?php

                   if ($action == 'Add') 
                    {
                            
                                    $sql = "SELECT * FROM `product_master` WHERE $name";
                                    $result = mysqli_query($conn, $sql);    
                                    
                            ?>

                         <tr>
                            <th>Product_name</th>
                                <td><select name="Product_name">
                                    <option value="0">--select--</option>
                                        <?php
                                                if ($result->num_rows > 0) 
                                                {
                                                    while ($row = $result->fetch_assoc()) 
                                                    {
                                        ?>
                                                      <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                                    <?php 
                                                    }
                                                }    
                                                    ?>
                                </td>
                        </tr>

                         <tr>
                            <th>Price</th>
                            <td><input type="text" name="Price"></td>
                        </tr>

                        <tr>
                            <th>Qty</th>
                            <td><input type="text" name="Qty" ></td>
                        </tr>

                         <tr>
                            <th>Discount</th>
                            <td><input type="text" name="Discount"></td>
                        </tr>

                         <tr>
                            <th>Total</th>
                            <td><input type="text" name="Total"></td>
                        </tr>

                    <?php 
                    }
                    ?>




                </form>
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


          
