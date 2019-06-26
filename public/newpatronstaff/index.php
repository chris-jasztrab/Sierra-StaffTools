<?php
 include('../../private/initialize.php');

$modalpop =
'<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4>Patron Created</h4>
            </div>
            <div class="modal-body">
                The patron was created in Sierra - <font color="red">You need to reset their PIN to the last 4 digits of their phone number</font>
            </div>
        </div>
    </div>
</div>
 <script>
 $(document).ready(function() {
 $("#myModal").modal("show");
});
</script>';

if(isset($_SESSION['showmodal'])) {
  echo $modalpop;
  unset($_SESSION['showmodal']);
  session_destroy();
  session_start();
}
  if (!is_post_request()) {
    session_destroy();
    session_start();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <title>Patron Search</title>

     <link href="./css/custom.css" rel="stylesheet" media="screen">



<script>
$("#critical_btn").click(function() {
  $(this).toggleClass('btn-default btn-success');
});
</script>


 </head>

<body>


  <form class="form-horizontal" id="patronsearchform" action='index.php' method="post">
<fieldset>

<!-- Form Name -->

   <h3><span class="label label-primary">STEP 1</span> &nbsp;&nbsp;Start by searching to see if the patron already exists</h3>
<!-- Text input-->
<br>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">First Name</label>
  <div class="col-md-4">
      <input id="first_name" name="first_name" type="text" placeholder="" class="form-control input-md" size="16" autocomplete="first_name">

  </div>
</div>

<!-- Button Drop Down -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Last Name</label>
  <div class="col-md-4">
      <input id="last_name" name="last_name" type="text" placeholder="" class="form-control input-md" size="16" autocomplete="last_name">

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Address</label>
  <div class="col-md-4">
      <input id="address" name="address" type="text" placeholder="" class="form-control input-md" size="16" autocomplete="address">
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Date of Birth</label>
  <div class="col-md-4">
    <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="date_of_birth" data-link-format="mm-dd-yyyy">
      <!--<div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="date_of_birth" data-link-format="yyyy-mm-dd">-->
      <input class="form-control" size="16" type="text" value="" readonly>
      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <input type="hidden" id="date_of_birth" name="date_of_birth" value="" /><br/>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">

    <button type="submit" id="btnSubmit" class="returnbutton">Search</button>&nbsp;&nbsp;&nbsp;
      <a href="/newpatronstaff/createpatron.php" class="returnbutton" onMouseOver="this.style.color='#FFFFFF'" onMouseOut="this.style.color='#FFFFFF'" style="background-color:#ffc107; border-color: #ffc107; text-decoration: none;" >Skip Search</a>&nbsp;&nbsp;&nbsp;


    <script>
        $(document).ready(function () {

            $("#patronsearchform").submit(function (e) {

                //disable the submit button
                $("#btnSubmit").attr("disabled", true);
                $("#btnSubmit").css('opacity', '0.6');
                $("#btnSubmit").text('Searching...');
                console.log('testing');

                return true;

            });
        });
    </script>

  </div>
</div>

</fieldset>
</form>



 <script type="text/javascript">

 	$('.form_date').datetimepicker({
         language:  'en',
         weekStart: 0,
         todayBtn:  1,
 		autoclose: 1,
 		todayHighlight: 1,
 		startView: 2,
 		minView: 2,
 		forceParse: 0
     });

 </script>

 </body>
 </html>



<?php }
if (is_post_request()) {

  $submitted_first_name = trim($_POST['first_name']);
  $submitted_last_name = trim($_POST['last_name']);
  $submitted_birth_date = $_POST['date_of_birth'];
  $submitted_address = trim($_POST['address']);

  ?>
  <html>
  <head>
    <script>

    $(document).ready( function () {
      $('#example').DataTable( {

      });
  } );

    </script>

  </head>
  <body>
      <h3><span class="label label-primary">STEP 2</span> &nbsp;&nbsp;These Patrons Matched Your Search</h3>
  <?php


  //$matchedPatron = findPatronByNameDOB('Chris', 'J', '');
  $matchedPatron = findPatronByNameDOB($submitted_first_name, $submitted_last_name, $submitted_birth_date, '', $submitted_address);
  //lb();

  lb();
  //var_dump($chris);
  ?>

  <table id="example" class="display" style="width:100%">
     <thead>
        <tr>
           <th>Barcode</th>
           <th>Name</th>
           <th>Email</th>
           <th>Expiration Date</th>
           <th>Fines Owed</th>
           <td># of Holds</th>

        </tr>
     </thead>
  <tbody>
    <?php
  foreach ($matchedPatron as $patron)

    {
      $link_detail = $patron['link'];
      $stripped_link = stripped($link_detail);
      $patron_info = getPatronDetails($stripped_link);
      //echo $patron_info['names'][0];
      //var_dump($patron_info);
      //$patronEmail = getPatronEmailAddress($stripped_link);
      $fines_owed = getTotalFinesOwed($stripped_link);
  ?>

     <?php

     echo '<tr>';
     echo '<td>' . $patron_info['barcodes'][0] . '</td>';
     echo '<td>' . $patron_info['names'][0] . '</td>';
     if(!empty($patron_info['emails'][0])) {
       echo '<td>' . $patron_info['emails'][0] . '</td>';
     }
     else {
       echo '<td>No email on file</td>';
     }
     echo '<td>';
     if(isPatronExpired($stripped_link)) {
       echo '<font color="red">';
     }
     echo $patron_info['expirationDate'] . '</font></td>';
     if($fines_owed > 0) {
       echo '<td>$' . number_format($fines_owed, 2) . '</td>';
     }
     else {
       echo '<td> No Fines Owed </td>';
     }
     echo '<td>' . getNumberOfHolds($stripped_link) . '</td>';
     echo '</tr>';
     }


     ?>
  </tbody>
<!--     <tfoot>
        <tr>
          <th>Barcode</th>
          <th>Name</th>
          <th>Email</th>
          <th>Expiration Date</th>
          <th>Fines Owed</th>
          <td># of Holds</th>
        </tr>
     </tfoot>
   -->
  </table>

<link href="./css/custom.css" rel="stylesheet" media="screen">



&nbsp;&nbsp;

<a href="/newpatronstaff/index.php" class="returnbutton" onMouseOver="this.style.color='#FFFFFF'" onMouseOut="this.style.color='#FFFFFF'" style="text-decoration: none;" >Start Over</a>&nbsp;&nbsp;&nbsp;
<a href="/newpatronstaff/createpatron.php" class="returnbutton" onMouseOver="this.style.color='#FFFFFF'" onMouseOut="this.style.color='#FFFFFF'"  style="background-color: rgb(92,184,92); border-color: rgb(92,184,92); text-decoration: none;">Continue Creating Patron</a>&nbsp;&nbsp;&nbsp;


  </body>
  </html>
<?php } ?>
