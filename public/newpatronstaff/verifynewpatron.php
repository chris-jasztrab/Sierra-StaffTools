<?php
 include('../../private/initialize.php');
  pre($_POST);
 if (is_post_request()) {
$pcode2result = get_iii_pcode2();
$pcode3result = get_iii_pcode3();
$patrontypesresult = get_patron_types();
$locationresult = get_branch_locations();

$_SESSION['last_name'] = trim(strtoupper($_POST['last_name']));
$_SESSION['first_name'] = trim(strtoupper($_POST['first_name']));
$_SESSION['date_of_birth'] = $_POST['date_of_birth'];
$_SESSION['street'] = trim(strtoupper($_POST['street']));
$_SESSION['city'] = trim(strtoupper($_POST['city']));
$_SESSION['province'] = strtoupper($_POST['province']);
$_SESSION['postalcode'] = trim(strtoupper($_POST['postalcode']));
$_SESSION['phonenumber'] = $_POST['phonenumber'];
$_SESSION['email'] = trim($_POST['email']);
$_SESSION['patrontype'] = $_POST['patrontype'];
$_SESSION['pcode2'] = $_POST['pcode2'];
$_SESSION['pcode3'] = $_POST['pcode3'];
$_SESSION['homelibrary'] = $_POST['homelibrary'];
$_SESSION['barcode'] = $_POST['barcode'];
$_SESSION['notice_preference'] = $_POST['notice_preference'];
$_SESSION['marketing_preference'] = $_POST['marketing_preference'];
if(isset($_POST['parentorguardian'])) {
  $_SESSION['parentorguardian'] = $_POST['parentorguardian'];
}
if(isset($_POST['familycheck']))
{
  $_SESSION['familycheck'] = 'on';
}
else {
  unset($_SESSION['familycheck']);
}


?>

   <!DOCTYPE html>
   <html>
   <head>
        <title>Patron Create</title>
         <link href="./css/custom.css" rel="stylesheet" media="screen">
         <script src="./js/custom.js"></script>
   </head>
   <body>
   <div class="container-fluid">
   <form id="patronCreateForm" class="form-horizontal" action='postpatron.php' method="post">
   <fieldset>

   <!-- Form Name -->

      <h3><span class="label label-primary">STEP 4</span> &nbsp;&nbsp;Please confirm the details of the new patron.</h3>
   <!-- Text input-->
   <br>



   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Name: </label>
     <div class="col-md-4">
      <?php echo strtoupper($_POST['last_name']) . ", " . strtoupper($_POST['first_name']); ?>
     </div>
   </div>


   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Date of Birth:</label>
     <div class="col-md-4">
      <?php echo $_POST['date_of_birth']; ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Street:</label>
     <div class="col-md-4">
      <?php echo strtoupper($_POST['street']); ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">City:</label>
     <div class="col-md-4">
      <?php echo strtoupper($_POST['city']); ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Province:</label>
     <div class="col-md-4">
      <?php echo $_POST['province']; ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Postal Code:</label>
     <div class="col-md-4">
      <?php echo strtoupper($_POST['postalcode']); ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Phone Number:</label>
     <div class="col-md-4">
      <?php echo $_POST['phonenumber']; ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Email Address:</label>
     <div class="col-md-4">
      <?php echo $_POST['email']; ?>
     </div>
   </div>

   <?php
   $postedpatrontype = $_POST['patrontype'];
   $patrontypeineed = $postedpatrontype + 1; ?>
   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Patron Type:</label>
     <div class="col-md-4">
       <?php while ($row = pg_fetch_array($patrontypesresult)) {

        if($row[1] == $patrontypeineed)
        {
          echo $row[0];
        }
       }
       ?>
     </div>
   </div>

<?php
 if(!empty($_POST['parentorguardian']))
 {?>
   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Parent or Guardian's Name:</label>
     <div class="col-md-4">
      <?php echo $_POST['parentorguardian']; ?>
     </div>
   </div>
<?php } ?>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Language Choice One:</label>
     <div class="col-md-4">
<?php
if($_POST['pcode2'] == '0') {
  echo 'No Language Chosen';
}
else {

  while ($row = pg_fetch_array($pcode2result)) {
   if($row[0] == $_POST['pcode2'])
   {
     echo $row[1];
   }
  }
}
?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Language Choice Two:</label>
     <div class="col-md-4">
       <?php
       if($_POST['pcode3'] == '0') {
         echo 'No Language Chosen';
       }
       else {

       while ($row = pg_fetch_array($pcode3result)) {

        if($row[0] == $_POST['pcode3'])
        {
          echo $row[1];
        }
       }
     }
   
   ?>

     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Home Library:</label>
     <div class="col-md-4">
       <?php while ($row = pg_fetch_array($locationresult)) {
        if($row[0] == $_POST['homelibrary'])
        {
          echo $row[1];
        }
       }
       ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Notice Preference:</label>
     <div class="col-md-4">
      <?php if($_POST['notice_preference'] == 'p') {
        echo 'Phone';
      }
      if($_POST['notice_preference'] == 'z') {
        echo 'Email';
      }
      if($_POST['notice_preference'] == 'a') {
        echo 'Print';
      }
       //echo $_POST['notice_preference']; ?>
     </div>
   </div>

   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Marketing Preference:</label>
     <div class="col-md-4">
      <?php if($_POST['marketing_preference'] == 'y') {
        echo 'Yes we can email marketing materials';
      }
      if($_POST['notice_preference'] == 'n') {
        echo 'Does not want marketing emails.';
      }

       //echo $_POST['notice_preference']; ?>
     </div>
   </div>


   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">Barcode:</label>
     <div class="col-md-4">
      <?php echo $_POST['barcode']; ?>
     </div>
   </div>


   <!-- Button -->
   <br>
   <div class="form-group">
     <label class="col-md-4 control-label" for="singlebutton"></label>
     <div class="col-md-4">

        <button type="submit" id="btnSubmit" class="returnbutton">Create Patron</button>&nbsp;&nbsp;&nbsp;
       <a href="/newpatronstaff/index.php" class="returnbutton" onMouseOver="this.style.color='#FFFFFF'" onMouseOut="this.style.color='#FFFFFF'" style="background-color:#ffc107; border-color: #ffc107; text-decoration: none;" >Start Over</a>&nbsp;&nbsp;&nbsp;

     </div>
   </div>


   <script>
       $(document).ready(function () {

           $("#patronCreateForm").submit(function (e) {

               //disable the submit button
               $("#btnSubmit").attr("disabled", true);
               $("#btnSubmit").css('opacity', '0.6');
               $("#btnSubmit").text('Adding Patron...');
               console.log('testing');

               return true;

           });
       });
   </script>

   </fieldset>
   </form>

<?php
} ?>
