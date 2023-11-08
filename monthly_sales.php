<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
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
          <h2 class="margin-top"> <?php  echo $c_sale['total']; ?></h2>
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
                <?php
            $premium = "premium";
            $sql = "SELECT SUM($premium) as totalSum FROM policy_sale";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalSum = $row["totalSum"];
                //echo"<h3>Total Premiums Paid: ZMW $totalSum</h3>";
            } 
            ?>
            
          <h2 class="margin-top"> ZMW <?php  echo $totalSum;?> </h2>
          <h5 class="text-success">Total Premiums Paid</h5>
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
            <?php
              $sumassured = "sumassured";
              $sql = "SELECT SUM($sumassured) as totalSum FROM policy_sale";
          
              $result = $conn->query($sql);
          
              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $totalSum = $row["totalSum"];
                
              }
            ?>
            
          <h2 class="margin-top"> ZMW <?php  echo $totalSum;?> </h2>
          <h5 class="text-success">Payable Intrest (Quarterly) </h5>
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
            <?php
                
              $totalsum = "totalsum";
              $sql = "SELECT SUM($totalsum) as totalSum FROM policy_sale";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $totalSum = $row["totalSum"];
              }  
            ?>
            
          <h2 class="margin-top"> ZMW <?php  echo $totalSum;?> </h2>
          <h5 class="text-success"> Total Sum Assured Payouts </h5>
        </div>
       </div>
    </div>
	</a>

  
</div>

  
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest Selling Products</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Title</th>
             <th>Total Sold</th>
           <tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT product, COUNT(product) as product_count FROM policy_sale GROUP BY product ORDER BY product_count DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $product1 = $row["product"];
                  $productCount1 = $row["product_count"];
                  echo "<tr>";
                  echo "<td> $product1</td>";
                  echo "<td>$productCount1</td>";
                  echo "<tr>";
              }
            } else {
                echo "No data found in the products table.";
              }
          ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>LATEST SALES</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th>Product Name</th>
           <th>Date</th>
           <th>Sum Assured</th>
         </tr>
       </thead>
       <tbody>
        <?php
           $sql = "SELECT * FROM policy_sale ORDER BY date DESC LIMIT 5";
           $result = $conn->query($sql);
           if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["totalsum"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found in the table.</td></tr>";
        }
        ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($recent_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                  <span class="label label-warning pull-right">
                 <?php echo (int)$recent_product['sale_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
<div class="row">
 
</div>

<?php include_once('layouts/footer.php'); ?>
