<?php
require_once './application/content/data/Connect.php';

class USER
{
	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

	public function register($fname,$lname,$uname,$umail,$upass,$code)
	{
		try
		{
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO users(first_name,last_name,user_name,user_email,user_pass,tokenCode) 
                                                VALUES(:fname, :lname, :uname, :umail, :upass, :active_code)");
			$stmt->bindparam(":fname", $fname);
			$stmt->bindparam(":lname", $lname);
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function login($umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE user_email=:email_id");
			$stmt->execute(array(":email_id"=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['user_pass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['user_id'];
						return true;
					}
					else
					{
						$_SESSION['error_msg'] = "I'm sorry your password was incorrect.";
						header("Location: Error");
						exit;
					}
				}
				else
				{
					$_SESSION['error_msg'] = "I'm sorry your account is inactive, please email Shaun so he can active it or check your email for your activation.";
					header("Location: Error");
					exit;
				}
			}
			else
			{
				$_SESSION['error_msg'] = "I'm sorry there was an error with your login.";
				header("Location: Error");
				exit;
			}
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}

	function send_mail($umail,$message,$subject)
	{
		require_once('./application/content/data/mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host       = "smtp.gmail.com";
		$mail->Port       = 465;
		$mail->AddAddress($umail);
		$mail->Username="SQuse23@gmail.com";
		$mail->Password="Mvccocc12";
		$mail->SetFrom('SQuse23@gmail.com','Shaun Quartier');
		$mail->AddReplyTo("SQuse23@gmail.com","Shaun Quartier");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
}
?>