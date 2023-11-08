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

   $req_fields = array('client','product','intrest','premium','duration');
   validate_fields($req_fields);

   if(empty($errors)){
       $client   = remove_junk($db->escape($_POST['client']));
       $product   = remove_junk($db->escape($_POST['product']));
       $intrest = (int)$db->escape($_POST['intrest']);
       $premium = (int)$db->escape($_POST['premium']);
       $time = (int)$db->escape($_POST['duration']);


       //Intrest Calculations.()
       $aintrest= $intrest/100;
       $quaterSum = ($aintrest * $premium);
       $yearamount = $premium*12;
       $totalPaid = $yearamount*$time;
       $totalSum = $quaterSum*4*$time+$totalPaid;


        $query = "INSERT INTO policy_sale (";
        $query .="product,premium,intrest,sumassured,totalsum,client,insurancePeriod";
        $query .=") VALUES (";
        $query .=" '{$product}', '{$premium}', '{$intrest}','{$quaterSum}','{$totalSum}','{$client}','{$time}'";
        $query .=")";

        
        if($db->query($query)){
          //sucess
          $session->msg('s',"Policy Sold! ");
          redirect('sales.php', false);
        } else {
          //failed
          $session->msg('d',' Sorry failed to create account!');
          redirect('policy_sale.php', false);
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
                            <option value="<?php echo $client['name'];?>"><?php echo ucwords($client['name']);?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="level">Policy</label>
                            <select class="form-control" name="product">
                            <?php foreach ($products as $product ):?>
                            <option value="<?php echo $product['name'];?>"><?php echo ucwords($product['name']);?></option>
                            <?php endforeach;?>
                            </select>
                            <br/>
                            <select class="form-control" name="intrest">
                            <?php foreach ($products as $product ):?>
                            <option value="<?php echo $product['sale_price'];?>"><?php echo ucwords($product['sale_price']);?> %</option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Monthly Premium</label>
                            <input type="text" class="form-control" name="premium" placeholder="Enter Premium">
                        </div>
                        <div>
                        <label for="level">Insurance Period (Years)</label>
                            <!-- <select class="form-control" name="duration">
                            <?php foreach ($products as $product ):?>
                            <option value="<?php echo $product['quantity'];?>"><?php echo ucwords($product['quantity']);?> Years</option>
                            <?php endforeach;?>
                            </select> -->

                            <input type="number" min="1" class="form-control" name="duration" placeholder="10 years">

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
