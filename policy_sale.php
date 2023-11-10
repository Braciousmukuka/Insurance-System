<?php
  $page_title = 'Sale Policy';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
 
  $groups = find_all('user_groups');
  $clients = find_all('clients');
  $products = find_all('products');
  
?>

<?php
  if(isset($_POST['policy_sale'])){

   $req_fields = array('client','product','interest','premium','duration');
   validate_fields($req_fields);

   if(empty($errors)){

       $client   = remove_junk($db->escape($_POST['client']));
      
       $array = explode("__", $client);
       $client = $array[0];
       $nrc = $array[1];

       //$client   = remove_junk($db->escape($_POST['client']));
      //  $nrc = remove_junk($db->escape($_POST['nrc']));

       $product   = remove_junk($db->escape($_POST['product']));
       $interest = (int)$db->escape($_POST['interest']);
       $premium = (int)$db->escape($_POST['premium']);
       $payment = 1;
       $time = (int)$db->escape($_POST['duration']);

       //Finding Nrc Number 
       //Interest Calculations.()
       $ainterest= $interest/100;
       $quaterSum = ($ainterest * $premium);
       $yearamount = $premium*12;
       $totalPaid = $yearamount*$time;
       $totalSum = $quaterSum*4*$time+$totalPaid;


        $query = "INSERT INTO policy_sale (";
        $query .="product,premium,interest,sumassured,totalsum,client,nrc,payments,insurancePeriod";
        $query .=") VALUES (";
        $query .=" '{$product}', '{$premium}', '{$interest}','{$quaterSum}','{$totalSum}','{$client}','{$nrc}','{$payment}','{$time}'";
        $query .=")";

          // Check for duplicate entry before inserting
          $checkDuplicate = $conn->query("SELECT COUNT(*) as count FROM policy_sale WHERE product = '$product' && client = '$client' ");
          $result = $checkDuplicate->fetch_assoc();
  
          if ($result['count'] == 0) {

            if($db->query($query)){
              //sucess
              $session->msg('s',"Policy Sold! ");
              redirect('sales.php', false);
            } 
          } else {
              // Duplicate entry} else {
                $session->msg('d',' Duplicate entry. Can not have the same Policy twice.');
                redirect('policy_sale.php',false);
          }

    } else {
      $session->msg("d", $errors);
        redirect('policy_sale.php',false);
    }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
    <div class="row">
        <div class="panel panel-default">
        <div class="panel-heading">
                <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Sale Policy</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <form method="post" action="policy_sale.php">
                        <div class="form-group">
                          <label for="level">Client Name</label>
                          <select class="form-control" name="client">
                          <?php foreach ($clients as $client):?>
                          <option value="<?php echo $client['name'] . "__" .$client['nrc'];?>"><?php echo ucwords($client['name']) . " (" . $client['nrc'] . ")";?></option>
                          <?php endforeach;?>
                          </select>
                          <br/>
                          <!-- <label for="nrc">Client N.R.C</label>
                          <select  class="form-control" name="nrc">
                          <?php foreach ($clients as $client):?>
                          <option value="<?php echo $client['nrc'];?>"><?php echo ucwords($client['nrc']);?></option>
                          <?php endforeach;?>
                          </select> -->
                          <input type="hidden" name="nrc" value="000">
                        </div>
                        <div class="form-group">
                        <label for="level">Policy</label>
                            <select class="form-control" name="product">
                            <?php foreach ($products as $product ):?>
                            <option value="<?php echo $product['name'];?>"><?php echo ucwords($product['name']);?></option>
                            <?php endforeach;?>
                            </select>
                            <br/>
                            <!-- <select class="form-control" name="interest">
                            <?php foreach ($products as $product ):?>
                            <option value="<?php echo $product['sale_price'];?>"><?php echo ucwords($product['sale_price']);?> %</option>
                            <?php endforeach;?>
                            </select> -->
                            <input type="number" min="1" class="form-control" name="interest" placeholder="Enter Interest (%)">

                        </div>
                        <div class="form-group">
                            <label for="name">Monthly Premium</label>
                            <input type="number" class="form-control" name="premium" placeholder="Enter Premium">
                        </div>
                        <div>
                        <label for="level">Insurance Period (Years)</label>
                            <!-- <select class="form-control" name="duration">
                            <?php foreach ($products as $product ):?>
                            <option value="<?php echo $product['quantity'];?>"><?php echo ucwords($product['quantity']);?> Years</option>
                            <?php endforeach;?>
                            </select> -->

                            <input type="number" min="1" class="form-control" name="duration" placeholder="Enter Number years">

                        </div>
                        <br/>
                        <div class="form-group clearfix">
                        <button type="submit" name="policy_sale" class="btn btn-success">Sale Policy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once('layouts/footer.php'); ?>
