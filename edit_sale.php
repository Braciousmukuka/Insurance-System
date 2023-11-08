<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sale = find_by_id('policy_sale',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('sales.php');
}
?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('product','client','intrest','sumA','TsumA', 'period');
    validate_fields($req_fields);
        if(empty($errors)){
          $product      = $db->escape($_POST['product']);
          $client      = $db->escape($_POST['client']);
          $intrest     = $db->escape((int)$_POST['intrest']);
          $sumA   =  $db->escape((int)$_POST['sumA']);
          $sumT   =   $db->escape((int)$_POST['TsumA']);
          $period    = $db->escape((int)$_POST['period']);

          $sql  = "UPDATE policy_sale SET";
          $sql .= " product='{$product}',client='{$client}',intrest='{$intrest}',sumassured='{$sumA}',totalsum='{$sumT}',insurancePeriod='{$period}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    $session->msg('s',"Sale updated.");
                    redirect('edit_sale.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('sales.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_sale.php?id='.(int)$sale['id'],false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
     </strong>
     <div class="pull-right">
       <a href="sales.php" class="btn btn-primary">Show all sales</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> Product name</th>
          <th> Cient name </th>
          <th> Verify Intrest </th>
          <th> Sum Assured(Quarterly) </th>
          <th> Total Sum Assured</th>
          <th> Insurance Period</th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="p_name">
                  <input type="text" class="form-control" id="sug_input" name="product" value="<?php echo remove_junk($sale['product']); ?>">
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_client">
                  <input type="text" class="form-control" name="client" value="<?php echo remove_junk($sale['client']); ?>">
                </td>
                <td id="s_intrest">
                  <input type="text" class="form-control" name="intrest" value="<?php echo (int)$sale['intrest']; ?>" >
                </td>
                <td id="s_sumAssured">
                  <input type="text" class="form-control" name="sumA" value="<?php echo (int)$sale['sumassured']; ?>" >
                </td>
                <td id="s_tsumAssured">
                  <input type="text" class="form-control" name="TsumA" value="<?php echo (int)$sale['totalsum']; ?>" >
                </td>
                <td>
                  <input type="text" class="form-control" name="period" value="<?php echo remove_junk($sale['insurancePeriod']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary">Update sale</button>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
