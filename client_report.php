<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);

   $user_id = (int)$_GET['id'];
   if(empty($user_id)):
     //redirect('home.php',false);
   else:
     $user_p = find_by_id('users',$user_id);
   endif;


    $targetUsername = $user_p['username'];

    // SQL query to retrieve data for the specific user
    $sql = "SELECT * FROM policy_sale WHERE username = 'muxtech.zm@gmail.com'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product = $row["product"];
            $premium = $row["premium"];
            $quaterSum = $row["sumassured"];
            $totalpay = $row["totalsum"];
            // Access and display the data as needed
            // For example: echo $row["column_name"];
        }
    } else {
        echo "No data found for the user.";
    }

?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('policy_sale');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $pSold = find_higest_saleing_policy('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5')
?>


<?php include_once('layouts/header.php'); ?>
	
	<a href="sales.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $product; ?></h2>
          <h5 class="text-muted">Sales</h5>
        </div>
       </div>
    </div>
	</a>

  <a href="sales.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
            
          <h2 class="margin-top"> ZMW <?php  echo $premium;?> </h2>
          <h5 class="text-success">Premium Payment</h5>
        </div>
       </div>
    </div>
	</a>

  <a href="sales.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
     
            
          <h2 class="margin-top"> ZMW <?php  echo $quaterSum;?> </h2>
          <h5 class="text-success">Payable Interest (Quarterly) </h5>
        </div>
       </div>
    </div>
	</a>

  <a href="sales.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
            
            
          <h2 class="margin-top"> ZMW <?php  echo $totalpay;?> </h2>
          <h5 class="text-success"> Total Sum Assured Payouts </h5>
        </div>
       </div>
    </div>
	</a>

  
</div>
<?php include_once('layouts/footer.php'); ?>
