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
 }

 if(!isset($_POST['familycheck']))
 {
   $familycheck = false;
 }
 else {
   $familycheck = $_POST['familycheck'];
 }

 ?>



<!DOCTYPE html>
<html>
<head>
     <title>Patron Create</title>
     <link href="./css/custom.css" rel="stylesheet" media="screen">

     

</head>
<body>
<div class="container-fluid">
<form id="patronCreateForm" class="form-horizontal" action='verifynewpatron.php' method="post" autocomplete="off">
<fieldset>

<!-- Form Name -->

   <h3><span class="label label-primary">STEP 3</span> &nbsp;&nbsp;Enter New Patron Details</h3>
<!-- Text input-->
<br>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">First Name and Middle Initial</label>
  <div class="col-md-4">
      <input id="first_name" name="first_name" type="text" placeholder="" class="form-control input-md" size="16" required autocomplete="first_name">

  </div>
</div>

<!-- Button Drop Down -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Last Name</label>
  <div class="col-md-4">
      <input id="last_name" name="last_name" type="text" placeholder="" class="form-control input-md" size="16" required autocomplete="last_name">

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Date of Birth</label>
  <div class="col-md-4">
    <div class="input-group date form_date" data-date="" data-date-format="yyyy-MM-dd" data-link-field="date_of_birth" data-link-format="yyyy-mm-dd">
      <input class="form-control" size="16" type="text" value="" readonly required>
      <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    <input type="hidden" id="date_of_birth" name="date_of_birth" value="<?php
    if(isset($_SESSION['date_of_birth'])) {
      echo $_SESSION['date_of_birth'];
    } ?>
    ">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Street</label>
  <div class="col-md-4">
      <input id="street" name="street" type="text" placeholder="" class="form-control input-md" size="16"
      <?php
      if(isset($_SESSION['familycheck'])) {
      if($_SESSION['familycheck'] == 'on') {
        echo 'value = "' . $_SESSION['street'] . '"';
      }
      }
      ?> required autocomplete="street">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">City</label>
  <div class="col-md-4">
      <input id="city" name="city" type="text" placeholder="" class="form-control input-md" size="16"

      <?php
  if(isset($_SESSION['familycheck'])) {
      if($_SESSION['familycheck'] = 'on') {
        echo 'value = "' . $_SESSION['city'] . '"';
      }
    }
      ?> required autocomplete="city">

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Province</label>
  <div class="col-md-4">
    <div class="dropdown">
      <select class="form-control input-small" name="province" id="province">
         <option value="AB">AB</option>
         <option value="BC">BC</option>
         <option value="MB">MB</option>
         <option value="NL">NL</option>
         <option value="NS">NS</option>
         <option value="NT">NT</option>
         <option value="NU">NU</option>
         <option value="ON" selected>ON</option>
         <option value="PE">PE</option>
         <option value="QC">QC</option>
         <option value="SK">SK</option>
         <option value="YT">YT</option>
       </select>
     </div>
   </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Postal Code</label>
  <div class="col-md-4">
      <input id="postalcode" name="postalcode" placeholder="A1A 1A1" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" type="text" placeholder="" class="form-control input-md" size="16"   <?php
      if(isset($_SESSION['familycheck'])) {
        if($_SESSION['familycheck'] == 'on') {
          echo 'value = "' . $_SESSION['postalcode'] . '"';
        }
      }
        ?> required autocomplete="postalcode">

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Phone Number</label>
  <div class="col-md-4">
      <input id="phonenumber" name="phonenumber" type="text" placeholder="" data-format="(ddd) ddd-dddd" class="form-control bfh-phone form-control input-md" size="16"   <?php
      if(isset($_SESSION['familycheck'])) {
        if($_SESSION['familycheck'] == 'on') {
          echo 'value = "' . $_SESSION['phonenumber'] . '"';
        }
      }
        ?> required autocomplete="phonenumber">

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Email Address</label>
  <div class="col-md-4">
      <input id="email" name="email" type="email" placeholder="" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" class="form-control input-md" size="16"<?php
      if(isset($_SESSION['familycheck'])) {
        if($_SESSION['familycheck'] == 'on') {
          echo 'value = "' . $_SESSION['email'] . '"';
        }
      }
        ?> autocomplete="patron_email">

  </div>
</div>

<?php $patrontypes = get_patron_types(); ?>
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput"><?php echo pcode4label; ?></label>
  <div class="col-md-4">
    <div class="dropdown">
      <select class="form-control input-small" name="patrontype" id="patrontype">
        <?php
          while ($row = pg_fetch_array($patrontypes)) {
            $row1Value = $row[1];
            $row1NewValue = $row1Value - 1;
            if($row1NewValue != 8)
            {
            echo '<option value="' . $row1NewValue . '"';
            //if($row[1] == '0') {
            //  echo ' selected>';
            //}
            //else {
              echo '>';
            //}
	echo $row[0];

        echo '</option>';
            lb();
          }
        }
          ?>
       </select>
     </div>
   </div>
</div>


<div id="parentorguardian" style="display: none;">
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Parent or Guardian's Name</label>
  <div class="col-md-4">

      <input id="parentorguardian" name="parentorguardian" type="text" placeholder="" style="background-color: #ffe793 " class="form-control input-md" size="16"

      <?php
  if(isset($_SESSION['familycheck'])) {
      if($_SESSION['familycheck'] = 'on') {
        echo 'value = "' . $_SESSION['parentorguardian'] . '"';
      }
    }
      ?> autocomplete="parentorguardian">

  </div>
</div>
</div>



<?php $pcode2_result = get_iii_pcode2();?>
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput"><?php echo pcode2label; ?></label>
  <div class="col-md-4">
    <div class="dropdown">
      <select class="form-control input-small" name="pcode2" id="pcode2">
        <?php
          while ($row = pg_fetch_array($pcode2_result)) {
            echo '<option value="' . $row[0] . '">';
	   if($row[1] == '---') {
		echo 'None';
	  }
	  else {
	echo $row[1];
	}
        echo '</option>';
            lb();
          }
          ?>
        <option value="0"selected>None</option>
       </select>
     </div>
   </div>
</div>

<?php $pcode3_result = get_iii_pcode3();?>
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput"><?php echo pcode3label; ?></label>
  <div class="col-md-4">
    <div class="dropdown">
      <select class="form-control input-small" name="pcode3" id="pcode3">
        <?php
          while ($row = pg_fetch_array($pcode3_result)) {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
            lb();
          }
          ?>
	<option value="0"selected>None</option>
       </select>
     </div>
   </div>
</div>

<?php $location_result = get_branch_locations(); ?>
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Home Library</label>
  <div class="col-md-4">
    <div class="dropdown">
      <select class="form-control input-small" name="homelibrary" id="homelibrary">
        <?php
          while ($row = pg_fetch_array($location_result)) {
            echo '<option value="' . $row[0] . '"';
            if($row[0] == 'm'){ echo 'selected';}
            echo '>' . $row[1] . '</option>';
            lb();
          }
          ?>
       </select>
     </div>
   </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Notice Preference</label>
  <div class="col-md-4">
    <div class="dropdown">
      <select class="form-control input-small" name="notice_preference" id="notice_preference" required>
         <option value="z" selected>Email</option>
         <option value="p">Phone</option>
         <option value="a">Print</option>
       </select>
     </div>
   </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Barcode</label>
  <div class="col-xs-2">
      <input pattern=".{14,14}" id="barcode" name="barcode" type="text" placeholder="" class="form-control input-md" size="14"  oninvalid="this.setCustomValidity('Incorrect Length')"
 oninput="setCustomValidity('')" required autocomplete="barcode">
  </div>

    <label class="col-sm-1 control-label" for="singlebutton">Can we email</label>
    <div class="col-xs-1">
      <div class="dropdown">
        <select class="form-control input-small" name="marketing_preference" id="marketing_preference" required>
           <option value="y" selected>Yes</option>
           <option value="n">No</option>
         </select>
       </div>
    </div>

</div>

<!-- Button -->

<div class="form-group">
  <label class="col-sm-4 control-label" for="singlebutton"></label>
  <div class="col-sm-2">
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="familycheck" name="familycheck"
      <?php
        if(isset($_SESSION['familycheck'])) {
          if($_SESSION['familycheck'] == 'on') { echo 'checked'; }
        } ?>>
      <label class="form-check-label" for="exampleCheck1">Check if creating family members</label>
      <br/><br/>
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" id="btnSubmit" class="returnbutton">Create Patron</button>&nbsp;&nbsp;&nbsp;
    <a href="/newpatronstaff/index.php" class="returnbutton" onMouseOver="this.style.color='#FFFFFF'" onMouseOut="this.style.color='#FFFFFF'" style="background-color:#ffc107; border-color: #ffc107; text-decoration: none;" >Start Over</a>&nbsp;&nbsp;&nbsp;
    <br><br>
  </div>
</div>

</fieldset>
</form>
</div>



 <script type="text/javascript">

 	$('.form_date').datetimepicker({
         language:  'en',
         weekStart: 0,
         todayBtn:  1,
 		autoclose: 1,
 		todayHighlight: 1,
 		startView: 2,
 		minView: 2,
 		forceParse: 1
     });

$('#myModal').css("margin-top", $(window).height() / 2 - $('.modal-content').height() / 2);

$("#patrontype").append($("#patrontype option").remove().sort(function(a, b) {
    var at = $(a).text(), bt = $(b).text();
    return (at > bt)?1:((at < bt)?-1:0);

}));

$(document).ready(function(){
    $('#patrontype option[value="0"]').attr("selected",true);
});

$("#pcode2").append($("#pcode2 option").remove().sort(function(a, b) {
    var at = $(a).text(), bt = $(b).text();
    return (at > bt)?1:((at < bt)?-1:0);
}));

$("#pcode3").append($("#pcode3 option").remove().sort(function(a, b) {
    var at = $(a).text(), bt = $(b).text();
    return (at > bt)?1:((at < bt)?-1:0);
}));

$(function () {
      $("#patrontype").change(function () {
          if ($(this).val() == "13" || $(this).val() == "1" ) {
              $("#parentorguardian").show();
          } else {
              $("#parentorguardian").hide();
          }
      });
  });

 </script>

 </body>
 </html>



<?php

 ?>
