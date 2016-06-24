<?php

$signid = $_SESSION['signupid'];
$signcode = $_SESSION['signupcode'];

if(empty($signid) && empty($signcode))
{
    $user->redirect('Home');
}

if(isset($signid) && isset($signcode))
{
    $id = base64_decode($signid);
    $code = $signcode;

    $statusY = "Y";
    $statusN = "N";

    $stmt = $user->runQuery("SELECT user_id,userStatus FROM users WHERE user_id=:uID AND tokenCode=:code LIMIT 1");
    $stmt->execute(array(":uID"=>$id,":code"=>$code));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
        if($row['userStatus']==$statusN)
        {
            $stmt = $user->runQuery("UPDATE users SET userStatus=:status WHERE user_id=:uID");
            $stmt->bindparam(":status",$statusY);
            $stmt->bindparam(":uID",$id);
            $stmt->execute();

            $msg = "
             <div class='alert alert-success'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Your Account is Now Activated! </strong><a href='Login'>Login Now</a>
          </div>
          ";
        }
        else
        {
            $msg = "
             <div class='alert alert-error'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Sorry!</strong>  Your Account is already Activated! <a href='Login'>Login here</a>
          </div>
          ";
        }
    }
    else
    {
        $msg = "
         <div class='alert alert-error'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Sorry!</strong>  No Account Found! <a href='Signup'>Signup here</a>
      </div>
      ";
    }
}

?>

<div id="main-content">
    <div id="left-side">
        <?php if(isset($msg)) {
            echo "<p>" . $msg . "</p>";
        } ?>
    </div>
</div> <!-- main-content -->