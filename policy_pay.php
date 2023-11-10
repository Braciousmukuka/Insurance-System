<?php
  $page_title = 'Process Payment';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
 
  $groups = find_all('user_groups');
  $clients = find_all('policy_sale');
  $products = find_all('products');
  
  
?>

<?php
  if(isset($_POST['policy_pay'])){

   $req_fields = array('client');
   validate_fields($req_fields);

   if(empty($errors)){
       $client   = remove_junk($db->escape($_POST['client']));
       $pay = find_payment($client);
       $pay_update = $pay+1;


        $query = "INSERT INTO policy_sale (client, payments)
        VALUES ('{$client}', '{$pay_update}')
        ON DUPLICATE KEY UPDATE payments = '{$pay_update}'";

            if($db->query($query)){
              //sucess
              $session->msg('s',"Premium Paid! ");
              redirect('sales.php', false);
            }  else {
                // Duplicate entry} else {
                  $session->msg('d',' Duplicate entry. Can not have the same Policy twice.');
                  redirect('policy_pay.php',false);
            }
          

    } else {
      $session->msg("d", $errors);
        redirect('policy_pay.php',false);
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
                <span>Process Payment</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <form method="post" action="policy_pay.php">
                        <div class="form-group">
                          <label for="level">Client Name</label>
                          <select class="form-control" name="client">
                          <?php foreach ($clients as $client):?>
                          <option value="<?php echo $client['client'];?>"><?php echo ucwords($client['client']);?></option>
                          <?php endforeach;?>
                          </select>
                          <br/>
                        </div>
                        <br/>
                        <div class="form-group clearfix">
                        <button type="submit" name="policy_pay" class="btn btn-success">Process Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once('layouts/footer.php'); ?>
