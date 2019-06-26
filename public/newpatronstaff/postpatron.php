<?php
 include('../../private/initialize.php');

 if (!is_post_request()) {
header('Location: \newpatronstaff\index.php');
 }

 if (is_post_request()) {

   $newPatronInfo = array(
   'email'=>$_SESSION['email'],
   'name'=>strtoupper($_SESSION['last_name']) . ", " . strtoupper($_SESSION['first_name']),
   'addressStreet'=>strtoupper($_SESSION['street']),
   '$citycommaProvince'=>strtoupper($_SESSION['city']) . ", " . $_SESSION['province'],
   'postalCode'=>strtoupper($_SESSION['postalcode']),
   'addressType'=>'a',
   'phonenumber'=>$_SESSION['phonenumber'],
   'numberType'=>'t',
   'barcode'=>$_SESSION['barcode'],
   'birthdate'=>$_SESSION['date_of_birth'],
   'homelibrary'=>$_SESSION['homelibrary']);

   $myAddress = [
     'country' => 'CA',
     'city' => strtoupper($_SESSION['city']),
     'postalCode' => strtoupper($_SESSION['postalcode']),
     'street' => strtoupper($_SESSION['street'])];

   $myNewPatron = createNewPatronStaff($newPatronInfo);
   $justpatronID = linkStripped($myNewPatron);
   $allPatronDetails = getAllPatronDetails($justpatronID);
   $pcode1value = updatePcode1Value($justpatronID, $myAddress);
   $pcode2value = updatePcode2Value($justpatronID, $_SESSION['pcode2']);
   $pcode3value = updatePcode3Value($justpatronID, $_SESSION['pcode3']);
   $updatePatronType = updatePatronType($justpatronID, $_SESSION['patrontype']);
   $updateNoticePreference = updateNoticePreference($justpatronID, $_SESSION['notice_preference']);
   if($_SESSION['marketing_preference'] == 'y') {
     $updateMarketingPreference = updatePatronNotes($justpatronID, 'MARKETING_PREFERENCE = TRUE');
     }
   $todaysDate = date('m/d/Y');
   $addPatronCreateDate = updatePatronNotes($justpatronID, 'Created via PatronWebForm v1 on ' . $todaysDate);
   if(!empty($_SESSION['parentorguardian'])) {
    updatePatronGuardian($justpatronID, $_SESSION['parentorguardian']);
   }

     if(isset($_SESSION['familycheck']))
     {
      $_SESSION['showmodal'] = 'yes';
       header('Location: /newpatronstaff/createpatron.php');
       //pre($_SESSION);
       //echo 'family check - should be adding more';
       exit();
     }
  session_destroy();
  session_start();
  $_SESSION['showmodal'] = 'yes';
  header('Location: /newpatronstaff/index.php');
  //pre($_SESSION);
  //echo 'no family check should go back to front page';
  exit();
}

 ?>

 </body>
 </html>



<?php
 ?>
