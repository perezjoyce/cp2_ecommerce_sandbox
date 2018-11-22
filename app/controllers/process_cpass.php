<?php

// ================= ERROR MESSAGE WHEN INPUT FIELDS ARE LEFT BLANK ===============
// ================= ERROR MESSAGE WHEN CPASS AND PASS ARE NOT THE SAME  ===============

$cpass = $_POST['cpass'];
$pass = $_POST['pass'];

if($cpass == "") {
    echo true;
} elseif($cpass !== $pass) {
   echo 3;  // any since i placed this in else at script.js
} else {
    echo false;
}


?>
