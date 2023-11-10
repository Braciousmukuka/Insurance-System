
<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   
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

    <a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
                <?php
            $payments = "payments";
            $cus = $user['username'];
            $sql = "SELECT SUM($payments) as totalSum FROM policy_sale Where client = '$cus'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalSum = $row["totalSum"];
                //echo"<h3>Total Premiums Paid: ZMW $totalSum</h3>";
            } 
            ?>
            
          <h2 class="margin-top"><?php  echo $totalSum;?> </h2>
          <h5 class="text-success">Number of Premiums Paid</h5>
        </div>
       </div>
    </div>
	</a>

  <a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
                <?php
            $premium = "premium";
            $payments = "payments";
            $cus = $user['username'];
            $sql = "SELECT SUM($premium) as totalSum FROM policy_sale Where client = '$cus'";
            $sql2 = "SELECT SUM($payments) as totalPay FROM policy_sale Where client = '$cus'";


            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalSum = $row["totalSum"];
               
            } 
            if ($result2->num_rows > 0) {
                $row = $result2->fetch_assoc();
                $totalPay = $row["totalPay"];
                
            } 

            $final = $totalSum * $totalPay;
            ?>
            
          <h2 class="margin-top"> ZMW <?php  echo $final;?> </h2>
          <h5 class="text-success">Premiums Paid@ <?php echo $totalSum;?> Monthly</h5>
        </div>
       </div>
    </div>
	</a>

  <a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
            <?php
              $sumassured = "sumassured";
              $cus = $user['username'];
              $sql = "SELECT SUM($sumassured) as totalSum FROM policy_sale Where client = '$cus'";
          
              $result = $conn->query($sql);
          
              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $totalSum = $row["totalSum"];
                
              }
            ?>
            
          <h2 class="margin-top"> ZMW <?php  echo $totalSum;?> </h2>
          <h5 class="text-success">Payable Interest (Quarterly) </h5>
        </div>
       </div>
    </div>
	</a>

  <a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
            <?php
                
              $totalsum = "totalsum";
              $cus = $user['username'];
              $sql = "SELECT SUM($totalsum) as totalSum FROM policy_sale Where client = '$cus'";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $totalSum = $row["totalSum"];
              }  
            ?>
            
          <h2 class="margin-top"> ZMW <?php  echo $totalSum;?> </h2>
          <h5 class="text-success"> Total Sum Assured</h5>
        </div>
       </div>
    </div>
	</a>

  
</div>

<?php include_once('layouts/footer.php'); ?>
