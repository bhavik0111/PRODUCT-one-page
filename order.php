<?php
  include("connect.php");
  
 
?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>&#128526; Order Form </title>

            </head>

            <body>
                <form method="POST">
                    <table border="1" align="center" cellpadding="15" cellspacing="0">

                        <tr>
                            <th colspan="2">
                                <h2>Order </h2>
                            </th>
                        </tr>

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
   }
   else
   {
    echo "<h4> failed in database </h4>";
   }
  }
  ?>


          
