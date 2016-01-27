<?php

require_once('connect.php');

/*

function register($email, $first, $last, $country, $user_request_date, $passwd) {
// register new person with db
// return true or error message

  // connect to db
  $conn = pdo_connect();
  
  // Statement Query
  $stmt = $conn->prepare("select * from user
                         where upper(email)=upper(:email)");
						 
$insert = $conn->prepare("insert into user (email, first, last, country, user_request_date, passwd)
						values (:email, 
								:first, 
								:last,
								:country,
								:user_request_date, 
								MD5(:passwd))");
								 
	//Begin Transaction
	$conn->beginTransaction();
	
	try	{
	if (!strong_password($passwd))
	{
	throw new Exception('Password does not meet requirements.');
	}
	
	$res = $stmt->execute(array(
					':email'=>trim($email)));
		if (!$res) {
			throw new Exception('Could not execute query');
		}
		if ($stmt->rowCount()>0)	{
			throw new Exception('<p>That email is taken - go back and enter another one.</p>');
		}
	$res = $insert->execute(array(
                     ':email'=>trim($email), 
					 ':first'=>trim($first), 
					 ':last'=>trim($last), 
					 ':country'=>trim($country),
					 ':user_request_date'=>trim($user_request_date), 
					 ':passwd'=>trim($passwd)));
					 
	if (!$res) {
    throw new Exception('Could not register you in database - please try again later.');
  }
	
	$conn->commit();
	}		
	catch(Exception $e)  {
	$conn->rollback();
	throw $e;
	return false;
		}

  return true;
}

//Submit Survery - Write to Database
function surveyAdd($surveyid, $adequate, $open_source, $enhancement, $email) {
// Enter a new survey with db
// return true or error message

  // connect to db
  $conn = pdo_connect();
  
  // Statement Query
  $stmt = $conn->prepare("select * from survey
                         where upper(surveyid)=upper(:surveyid)");
						 
$insert = $conn->prepare("insert into survey (adequate, open_source, enhancement, email)
						values (:adequate, 
								:open_source, 
								:enhancement,
								:email)");
								 
	//Begin Transaction
	$conn->beginTransaction();
	
	try	{
	$res = $stmt->execute(array(
					':surveyid'=>trim($surveyid)));
		if (!$res) {
			throw new Exception('Could not execute query');
		}
		if ($stmt->rowCount()>0)	{
			throw new Exception('<p>That survey is taken - go back and enter another one.</p>');
		}
	$res = $insert->execute(array(
                     ':adequate'=>trim($adequate), 
					 ':open_source'=>trim($open_source), 
					 ':enhancement'=>trim($enhancement), 
					 ':email'=>trim($email)));
					 
	if (!$res) {
    throw new Exception('Could not enter the survey in database - please try again later.');
  }
	
	$conn->commit();
	}		
	catch(Exception $e)  {
	$conn->rollback();
	throw $e;
	return false;
		}

  return true;
}

function update_user($email, $first, $last, $country, $program, $lcluc, $contract, $pi, $institution, $usage_primary) {
// UPDATE new person in DATABASE
// return true or error message

  // connect to db
  $conn = pdo_connect();
  
  // Statement Query
  $stmt = $conn->prepare("select * from user
                         where upper(email)=upper(:email)");
						 
$update = $conn->prepare("update user
							set first = :first,
							last = :last, 
							country = :country,  
							program = :program, 
							lcluc = :lcluc, 
							contract = :contract,
							pi = :pi, 
							institution = :institution,
							usage_primary = :usage_primary
                          	where upper(email) = upper(:email)");
								 
	//Begin Transaction
	$conn->beginTransaction();
	
	try	{
	$res = $stmt->execute(array(
					':email'=>trim($email)));
		if (!$res) {
			throw new Exception('Could not execute query');
		}
		if ($stmt->rowCount() != 1)	{
			throw new Exception('<p>Email is not registered.</p>');
		}
	$res = $update->execute(array(
                     ':email'=>trim($email),
					 ':first'=>trim($first),
					 ':last'=>trim($last),
					 ':country'=>trim($country), 
					 ':program'=>trim($program), 
					 ':lcluc'=>trim($lcluc), 
					 ':contract'=>trim($contract),
					 ':pi'=>trim($pi), 
					 ':institution'=>trim($institution),
					 ':usage_primary'=>trim($usage_primary)));
					 
	if (!$res) {
    throw new Exception('Sorry your records could not be updated at this time. Please try again later.');
  }
	
	$conn->commit();
	}		
	catch(Exception $e)  {
	$conn->rollback();
	throw $e;
	return false;
		}

  return true;
}

//Data Use Agreement Page
function update_data_use($email, $data_use_agree) {
// return true or error message

  // connect to db
  $conn = pdo_connect();
  
  // Statement Query
  $stmt = $conn->prepare("select * from user
                         where upper(email)=upper(:email)");
						 
$update = $conn->prepare("update user
							set data_use_agree = :data_use_agree
                          	where upper(email) = upper(:email)");
								 
	//Begin Transaction
	$conn->beginTransaction();
	
	try	{
	$res = $stmt->execute(array(
					':email'=>trim($email)));
		if (!$res) {
			throw new Exception('Could not execute query');
		}
		if ($stmt->rowCount() != 1)	{
			throw new Exception('<p>Email is not registered.</p>');
		}
	$res = $update->execute(array(
                     ':email'=>trim($email),
					 ':data_use_agree'=>trim($data_use_agree)));
					 
	if (!$res) {
    throw new Exception('Sorry your records could not be updated at this time. Please try again later.');
  }
	
	$conn->commit();
	}		
	catch(Exception $e)  {
	$conn->rollback();
	throw $e;
	return false;
		}

  return true;
}

*/

function login($email, $passwd) {
// check email and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = pdo_connect();
  
  // Statement Query
  $stmt = $conn->prepare("select * from user
                         where upper(email)=upper(:email)
                         and passwd=MD5(:passwd)");
	
	$res = $stmt->execute(array(
		':email'=>trim($email),
		':passwd'=>trim($passwd) 
	));						 

	if (!$res || $stmt->rowCount() != 1)	{
		throw new Exception('<p>Could not log you in. Poop</p>');
		return false;
	}
	return true;
}

function check_valid_user_menu() {
// see if somebody is logged in and notify them if not
  if (!empty($_SESSION['valid_user']))  {
      echo "<li class='has-sub last'><a href='#'><span>User Options</span></a>
      		<ul>
		 		<li><a href='#'><span>User Profile</span></a></li>
         		<li><a href='#'><span>Change Password</span></a></li>
         		<li class='last'><a href='./application/content/Logout'><span>Logout</span></a></li>
			</ul>
   		 </li>";
  } else {
     // they are not logged in
	 echo "<li><a href='../Login'><span>Admin Login</span></a></li>";
  }
}

function check_valid_user_page() {
// see if somebody is logged in and notify them if not
  if (!empty($_SESSION['valid_user']))  {
      echo "";
  } else {
     // they are not logged in
	 echo "Your not currently logged in. Please <a href='../Login'>Login</a> in order to use this feature.";
     exit;
  }
}
/*

----- NEW -----

function searchAdd($query_id, $lat, $lon, $ul_lat, $ul_long, $lr_lat, $lr_long, $buffer, $fromdate, $todate, $ge, $wv, $qb, $ov, $ik, $email, $status, $request_date, $search_date, $inventory) {
// register new person with db
// return true or error message

  // connect to db
$conn = pdo_connect();

//Statement Query
$stmt = $conn->prepare("select * from query
                         where upper(email)=upper(:email)");
                              
     $insert = $conn->prepare("insert into query (query_id, lat, lon, ul_lat, ul_long, lr_lat, lr_long, buffer, fromdate, todate, ge, wv, qb, ov, ik, email, status, request_date, search_date, inventory)
                                        values (:query_id,
												  :lat,
                                                  :lon,
                                                  :ul_lat,
                                                  :ul_long,
                                                  :lr_lat,
                                                  :lr_long,
                                                  :buffer,
                                                  :fromdate,
                                                  :todate,
                                                  :ge,
                                                  :wv,
                                                  :qb,
                                                  :ov,
                                                  :ik,
                                                  :email,
                                                  :status,
                                                  :request_date,
                                                  :search_date,
                                                  :inventory)");
                                                  
     //Begin Transaction
     $conn->beginTransaction();
     
     try     {
     $res = $insert->execute(array(
	 					 ':query_id'=>trim($query_id), 
                         ':lat'=>trim($lat), 
                         ':lon'=>trim($lon), 
                         ':ul_lat'=>trim($ul_lat), 
                         ':ul_long'=>trim($ul_long), 
                         ':lr_lat'=>trim($lr_lat), 
                         ':lr_long'=>trim($lr_long), 
                         ':buffer'=>trim($buffer), 
                         ':fromdate'=>trim($fromdate), 
                         ':todate'=>trim($todate), 
                         ':ge'=>trim($ge), 
                         ':wv'=>trim($wv), 
                         ':qb'=>trim($qb), 
                         ':ov'=>trim($ov), 
                         ':ik'=>trim($ik), 
                         ':email'=>trim($email), 
                         ':status'=>trim($status), 
                         ':request_date'=>trim($request_date),
                         ':search_date'=>trim($search_date),
                         ':inventory'=>trim($inventory)));
                         
     if (!res)     {
          throw new Exception('Could not submit your request in the database. Please try again later.');
     }
     
     $conn->commit();
     }
     catch(Exception $e)     {
     $conn->rollback();
     throw $e;
     return false;
          }
          
     return true;
}

*/
function searchAdd($query_id, $lat, $lon, $ul_lat, $ul_long, $lr_lat, $lr_long, $buffer, $study_area, $fromdate, $todate, $ge, $wv, $qb, $ov, $ik, $email, $status, $request_date, $search_date, $inventory, $cidr) {
// register new person with db
// return true or error message

  // connect to db
  $conn = db_connect();

  // if ok, put in db
  $result = $conn->query("insert into query values
                         ('".$query_id."', '".$lat."', '".$lon."', '".$ul_lat."', '".$ul_long."', '".$lr_lat."', '".$lr_long."', '".$buffer."', '".$study_area."', '".$fromdate."', '".$todate."', '".$ge."', '".$wv."', '".$qb."', '".$ov."', '".$ik."', '".$email."', '".$status."', '".$request_date."', '".$search_date."', '".$inventory."', '".$cidr."')");
  if (!$result) {
    throw new Exception('Your search could not be entered - please try again later.');
  }

  return true;
}


// CHANGE PASSWORD SCRIPT
function change_password($email, $old_password, $new_password) {
// change password for email/old_password to new_password
// return true or false

  // if the old password is right
  // change their password to new_password and return true

  // else throw an exception
  login($email, $old_password);
  $conn = pdo_connect();
  
  $stmt = $conn->prepare("select * from user
                         where upper(email)=upper(:email)");
  
  $update_passwd = $conn->prepare("update user
                          set passwd = MD5(:new_password)
                          where email = '".$email."'");
						  
  //Begin Transaction
	$conn->beginTransaction();

  try	{
	$res = $stmt->execute(array(
					':email'=>trim($email)));
		if (!$res) {
			throw new Exception('Could not execute query');
		}
	$res = $update_passwd->execute(array(
                     ':new_password'=>trim($new_password)));
					 
	if (!$res) {
    throw new Exception('Sorry your records could not be updated at this time. Please try again later.');
  }
	
	$conn->commit();
	}		
	catch(Exception $e)  {
	$conn->rollback();
	throw $e;
	return false;
		}

  return true;
}

/*
// RESET PASSWORD SCRIPT
function reset_password($email) {
// set password for email to a random value
// return the new password or false on failure
  // get a random dictionary word b/w 6 and 13 chars in length
  $new_password = get_random_word(6, 13);

  if($new_password == false) {
    throw new Exception('Could not generate new password.');
  }

  // add a number  between 0 and 999 to it
  // to make it a slightly better password
  $rand_number = rand(0, 999);
  $new_password .= $rand_number;

  // set user's password to this in database or return false
  $conn = db_connect();
  $result = $conn->query("update user
                          set passwd = '".$new_password."'
                          where email = '".$email."'");
  if (!$result) {
    throw new Exception('Could not change password.');  // not changed
  } else {
    return $new_password;  // changed successfully
  }
}


// Needs to be Changed!!!
function notify_password($email, $password) {
// notify the user that their password has been changed

    $conn = db_connect();
    $result = $conn->query("select email from user
                            where email='".$email."'");
    if (!$result) {
      throw new Exception('Could not find email address.');
    } else if ($result->num_rows == 0) {
      throw new Exception('Could not find email address.');
      // email not in db
    } else {
      $row = $result->fetch_object();
      $email = $row->email;
      $from = "Shaun.Quartier@sigmaspace.com";
      $mesg = "Your password has been changed to ".$password."\r\n"
              ."Please change it next time you log in.\r\n";
	  $headers = "From:" . $from;
	  $subject = "Login Information";
      if (mail($email, $subject, $mesg, $headers)) {
        return true;
      } else {
        throw new Exception('Could not send email.');
      }
    }
}
*/
?>
