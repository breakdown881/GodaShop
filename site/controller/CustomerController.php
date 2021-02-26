<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use \Firebase\JWT\JWT;

class CustomerController {
	function register() {
		// $secret = "6LddhskZAAAAAJQL3EV0qFwmDdm0fr_7yot9aske";
		// $recaptcha = new \ReCaptcha\ReCaptcha($secret);
		// $token = $_POST["g-recaptcha-response"];
		// $resp = $recaptcha->setExpectedHostname(get_domain())
		//                   ->verify($token, "127.0.0.1");
		// if (!$resp->isSuccess()) {
		// 	echo "Error: " . implode(" , ", $resp->getErrorCodes());
		// 	exit;
		// }
		//echo "path recaptcha";
		$reference = $_POST["reference"];
		$name = $_POST["fullname"];
		$mobile = $_POST["mobile"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$data = array(
			"name" => $name,
			"mobile" => $mobile,
			"password" => md5($password),
			"email" => $email,
			"shipping_name" => $name,
			"shipping_mobile" => $mobile,
			"ward_id" => null,
			"housenumber_street" => null,
			"login_by" => "form",
			"is_active" => 0,
		);
		
		$customerRepository = new CustomerRepository();
		if ($customerRepository->save($data)) {
			$from_email = FROM_EMAIL;
			$from_name = FROM_NAME;
			$to_email = $email;
			$to_name = $name;
			$subject = "Active account";
			$key = JWT_SECRET_KEY;
			$payload = array(
			    "email" => $email
			);
			$jwt = JWT::encode($payload, $key);
			$code = $jwt;
			$link = get_link_site()."?c=customer&a=activeAccount&code=$code";
			$content = "<a href='$link'>Active Account</a>";
			if ($this->sendEmail($from_email, $from_name, $to_email, $to_name, $subject, $content)){
				header("location: $reference");
			}
			
			exit;
		}
		else {
			echo $customerRepository->getError();
		}
	}

	function infoAccount() {
		include_once "checkLogin.php";
		session_id() || session_start();
		$email = $_SESSION["email"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		include_once "view/customer/infoAccount.php";
	}
	
	function activeAccount() {
		//decode jwt
		$key = JWT_SECRET_KEY;
		$jwt = $_GET["code"];
		$payload = JWT::decode($jwt, $key, array('HS256'));
		$email = $payload->email;
		//active this email
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		$customer->setIsActive(1);
		$customerRepository->update($customer);
		header("location:".get_link_site());
	}

	function forgotPW() {
		$email = $_POST["email"];
		$reference = $_POST["reference"];
		$from_email = FROM_EMAIL;
		$from_name = FROM_NAME;
		$to_email = $email;
		$to_name = "";
		$subject = "Reset Password";
		$key = JWT_SECRET_KEY;
		$payload = array(
		    "email" => $email
		);
		$jwt = JWT::encode($payload, $key);
		$code = $jwt;
		$link = get_link_site()."?c=customer&a=reset&code=$code";
		$content = "<a href='$link'>Reset</a>";
		if ($this->sendEmail($from_email, $from_name, $to_email, $to_name, $subject, $content)){
			header("location: $reference");
		}
		exit;
	}

	function reset() {
		//decode jwt
		$key = JWT_SECRET_KEY;
		$jwt = $_GET["code"];
		$payload = JWT::decode($jwt, $key, array('HS256'));
		$email = $payload->email;
		//active this email
		include_once "view/customer/reset.php";
	}

	function updatePW() {
		$jwt = $_POST["code"];
		$new_password = $_POST["password"];
		$key = JWT_SECRET_KEY;
		$payload = JWT::decode($jwt, $key, array('HS256'));
		$email = $payload->email;
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		$customer->setPassword(md5($new_password));
		if ($customerRepository->update($customer)) {
			header("location:".get_link_site());
		}
	}

	function saveInfoAccount() {
		include_once "checkLogin.php";
		session_id() || session_start();
		$email = $_SESSION["email"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		$name = $_POST["fullname"];
		$mobile = $_POST["mobile"];
		$password = $_POST["password"];
		$customer->setName($name);
		$customer->setMobile($mobile);
		if ($customer->getLoginBy() == "form" && !empty($password)) {
			$customer->setPassword(md5($password));
		}
		
		if ($customerRepository->update($customer)) {
			header("location:index.php?c=customer&a=infoAccount");
		}
	}

	function shippingAddress() {
		include_once "checkLogin.php";
		session_id() || session_start();
		$email = $_SESSION["email"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		$provinceRepository = new ProvinceRepository();
		$provinces = $provinceRepository->getAll();
		include_once "view/customer/shippingAddress.php";
	}

	function saveShippingAddress() {
		include_once "checkLogin.php";
		session_id() || session_start();
		$email = $_SESSION["email"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		$name = $_POST["fullname"];
		$mobile = $_POST["mobile"];
		$ward = $_POST["ward"];
		$address = $_POST["address"];
		//var_dump($_POST);
		$customer->setShippingName($name);
		$customer->setMobile($mobile);
		$customer->setWardId($ward);
		$customer->setHousenumberStreet($address);
		//var_dump($customer);
		
		if ($customerRepository->update($customer)) {
			//header("location:index.php?c=customer&a=shippingAddress");
		}
	}

	function sendEmail($from_email, $from_name, $to_email, $to_name, $subject, $content) {
		
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->SMTPDebug =
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'truongtienithufi@gmail.com';                     // SMTP username
		    $mail->Password   = 'vvofiaaxwpxjpbma';                               // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom($from_email, $from_name);
		    $mail->addAddress($to_email, $to_name);     // Add a recipient            // Name is optional
		    $mail->addReplyTo($from_email, $from_name);

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $content;
		    $mail->AltBody = $content;

		    $mail->send();
		    return true;
		    
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	function testJWT() {
		$key = "godashop100";
		$payload = array(
		    "email" => "abcd@gmail.com"
		);
		$jwt = JWT::encode($payload, $key);
		echo $jwt;

		$x = JWT::decode($jwt, $key, array('HS256'));
		var_dump($x);
	}

	function sendContact() {
		//Lấy thông tin từ $_POST;
		//$this->sendEmail(...);
		//header("location:trang contact");
	}

}