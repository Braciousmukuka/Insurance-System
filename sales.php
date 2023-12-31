<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all_sale();
$psales = find_all_Psale() ;
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All Sales</span>
          </strong>
          <div class="pull-right">
            <a href="policy_sale.php" class="btn btn-primary">Add sale</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th> Client name </th>
                <th> Client N.R.C </th>
                <th class="text-center" style="width: 15%;">Monthly Premium</th>
                <th class="text-center" style="width: 15%;">Premiums Paid</th>
                <th class="text-center" style="width: 15%;"> Interest</th>
                <th class="text-center" style="width: 15%;"> Sum Assured (Quarterly) </th>
                <th class="text-center" style="width: 15%;"> Total Sum Assured </th>
                <th class="text-center" style="width: 15%;"> Insurance Period </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($psales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['product']); ?></td>
               <td><?php echo remove_junk($sale['client']); ?></td>
               <td><?php echo remove_junk($sale['nrc']); ?></td>
               <td class="text-center"><?php echo remove_junk("ZMW ".  $sale['premium']) ?></td>
               <td class="text-center"><?php echo remove_junk($sale['payments']) ?></td>
               <td class="text-center"><?php echo (int)$sale['interest']." %"; ?></td>
               <td class="text-center"><?php echo remove_junk("ZMW ".  $sale['sumassured']); ?></td>
               <td class="text-center"><?php echo remove_junk("ZMW ".  $sale['totalsum']); ?></td>
               <td class="text-center"><?php echo remove_junk($sale['insurancePeriod']); ?> Years </td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
