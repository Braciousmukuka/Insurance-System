<?php
  $page_title = 'Process Payment';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
 
  $clients = find_all('policy_sale');
?>

<?php
  if(isset($_POST['policy_pay'])){

   $req_fields = array('client','payments');
   validate_fields($req_fields);

   if(empty($errors)){
       $client   = remove_junk($db->escape($_POST['client']));
       $payments = (int)$db->escape($_POST['payments']);


       $query = "UPDATE policy_sale 
          SET payments = '{$payments}' 
          WHERE client = '{$client}'";

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
                          <label for="payments">Payments Made </label>                        
                          <input type="number" min="1" class="form-control" name="payments" placeholder="Enter Number of Payments ">
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
