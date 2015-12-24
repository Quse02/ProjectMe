<?php

function filled_out($form_vars) {
  // test that each variable has a value
  foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
        return false;
		echo "Must fill out all fields. Please go back and fix these errors.<br /><br />";
     }
  }
  return true;
}

function valid_email($address) {
  // check an email address is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address)) {
    return true;
  } else {
    return false;
  }
}

function valid_sigma_email($sigmaaddress) {
  // check an email address is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]+@[sigmaspace.com]+$', $sigmaaddress)) {
    return true;
  } else {
    return false;
	echo "I'm sorry, we only accept SigmaSpace Email accounts. Please go back and use a valid Sigma email.<br /><br />";
  }
}

function valid_fromdate($date) {
  // check a from date is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]', $date)) {
    return true;
  } else {
    return false;
  }
}

function valid_todate($dateb) {
  // check a to date is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]', $dateb)) {
    return true;
  } else {
    return false;
  }
}

?>
