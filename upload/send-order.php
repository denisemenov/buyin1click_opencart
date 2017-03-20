<?php

function replace_shablon($string){
	global $product, $name, $phone, $email, $shop_name;

	$patterns[0] = "/\{shop_name\}/";
	$patterns[1] = "/\{product\}/";
	$patterns[2] = "/\{name\}/";
	$patterns[3] = "/\{phone\}/";
	$patterns[4] = "/\{email\}/";

	$replacements[0] = $shop_name;
	$replacements[1] = $product;
	$replacements[2] = $name;
	$replacements[3] = $phone;
	$replacements[4] = $email;
	return preg_replace($patterns, $replacements, $string);
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	// Подключаем конфиг для TurboSMS
	include "config.php"; 

	// Осуществляем проверку вводимых данных и их защиту от враждебных скриптов
	$product = trim(strip_tags($_POST["product"]));
	$product_body = "Вам пришёл заказ на ";
	$product_body .= $_POST["product"];
	$post_name = htmlspecialchars($_POST["name"]);
	$name = strip_tags(mb_convert_encoding($post_name, 'UTF-8', mb_detect_encoding($post_name)));
	$email = htmlspecialchars($_POST["email"]);
	$phone = htmlspecialchars($_POST["phone"]);
	$message = htmlspecialchars($_POST["message"]);

	// Устанавливаем e-mail адресата
	$myemail = $_POST["admin_email"];

	// Создаем новую переменную, присвоив ей значение
	$message_to_myemail = "Здравствуйте! <br /><br />
	$product_body<br /><br />
	Имя покупателя: $name <br />
	Телефон покупателя: <a href='tel:$phone'>$phone</a><br />";
	if ($email=='') {
		$message_to_myemail .= "<br />";
	}
	else {
		$message_to_myemail .= "E-mail покупателя: <a href='mailto:$email'>$email</a><br />";
	}
	if ($message=='') {
		$message_to_myemail .= "<br /><br />Удачных продаж!";
	}
	else {
		$message_to_myemail .= "Сообщение: $message <br /><br /><br />Удачных продаж!";
	}

	// Соединение с БД
	$db_host = constant("DB_HOSTNAME");
	$db_database = constant("DB_DATABASE");
	$db_username = constant("DB_USERNAME");
	$db_password = constant("DB_PASSWORD");
	$db_prefix = constant("DB_PREFIX");
	$db_table = $db_prefix . 'setting';

	$db_link = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	$set_charset = mysqli_set_charset($db_link, "utf8");
    $result = mysqli_query($db_link, "SELECT * FROM `$db_table` WHERE `code` = 'buyinoneclick_' OR `code` = 'config'");

    while ($row = mysqli_fetch_assoc($result)) {
		switch ($row['key']) {
			case 'config_name' :
				$shop_name = $row['value'];
				break;
			case 'buyinoneclick_turbosms_status' :
				$turbosms_status = $row['value'];
				break;
			case 'buyinoneclick_turbosms_client_status' :
				$turbosms_client_status = $row['value'];
				break;
			case 'buyinoneclick_turbosms_login' :
				$turbosms_login = $row['value'];
				break;
			case 'buyinoneclick_turbosms_password' :
				$turbosms_password = $row['value'];
				break;
			case 'buyinoneclick_turbosms_number' :
				$turbosms_number = $row['value'];
				break;
			case 'buyinoneclick_turbosms_name' :
				$turbosms_name = $row['value'];
				break;
			case 'buyinoneclick_turbosms_admin_sms' :
				$turbosms_admin_sms = $row['value'];
				break;
			case 'buyinoneclick_turbosms_client_sms' :
				$turbosms_client_sms = $row['value'];
				break;
			case 'buyinoneclick_smsru_status' :
				$smsru_status = $row['value'];
				break;
			case 'buyinoneclick_smsru_client_status' :
				$smsru_client_status = $row['value'];
				break;
			case 'buyinoneclick_smsru_api' :
				$smsru_api = $row['value'];
				break;
			case 'buyinoneclick_smsru_login' :
				$smsru_login = $row['value'];
				break;
			case 'buyinoneclick_smsru_password' :
				$smsru_password = $row['value'];
				break;
			case 'buyinoneclick_smsru_number' :
				$smsru_number = $row['value'];
				break;
			case 'buyinoneclick_smsru_name' :
				$smsru_name = $row['value'];
				break;
			case 'buyinoneclick_smsru_admin_sms' :
				$smsru_admin_sms = $row['value'];
				break;
			case 'buyinoneclick_smsru_client_sms' :
				$smsru_client_sms = $row['value'];
				break;
		}
    }

	$shop_name = mb_convert_encoding($shop_name, 'UTF-8', mb_detect_encoding($shop_name));

	// SMS покупателю
	$client_sms = "Спасибо за Ваш заказ на $product в интернет-магазине $shop_name! Мы свяжемся с Вами для подтверждения заказа!";

	// SMS админу
	$admin_sms = "Заказ: $product. Покупатель: $name, $phone, $email.";

	if ($turbosms_status == '1') {

		$message_to_myemail .= "
			<br /><br />Сатус TurboSMS: $turbosms_status
			<br />Turbosms Number: $turbosms_number
			<br />Turbosms Name: $turbosms_name
			<br />Turbosms login: $turbosms_login
			<br />Turbosms password: $turbosms_password <br /><br />
		";

		// TurboSMS покупателю
		if ($turbosms_client_sms != '') {
			$client_sms = replace_shablon($turbosms_client_sms);
		}
		// TurboSMS админу
		if ($turbosms_admin_sms != '') {
			$admin_sms = replace_shablon($turbosms_admin_sms);
		}

		try {

			// Подключаемся к серверу
			$client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');

			// Данные авторизации
			$auth = array(
				'login' => $turbosms_login,
				'password' => $turbosms_password
			);

			// Авторизируемся на сервере
			$auth_result = $client->Auth($auth);

			// Результат авторизации
			$message_to_myemail .= '<br /><br /><hr /><br /><strong>TurboSMS.ua</strong><br /><br />Авторизация на TurboSMS.ua: ' . $auth_result->AuthResult . '<br />';

			if ($auth_result) {

				// Получаем количество доступных кредитов
				$credit_result = $client->GetCreditBalance();

				// Отправляем сообщение на один номер (администратору магазина)
				// Подпись отправителя может содержать английские буквы и цифры. Максимальная длина - 11 символов
				// Номер указывается в полном формате, включая плюс и код страны
				if (intval($credit_result) > 0) {
					$sms_sender = $turbosms_name;
					$sms_sender = mb_convert_encoding($sms_sender, 'UTF-8', mb_detect_encoding($sms_sender));


					$sms = array(
						'sender' => $sms_sender,
						'destination' => $turbosms_number,
						'text' => $admin_sms
					);
					$result = $client->SendSMS($sms);

					$new_result_error = $result->SendSMSResult->ResultArray;
					$new_result = $result->SendSMSResult->ResultArray[0];

					if ( ! is_array($new_result_error) ) {
						$message_to_myemail .= 'Результат отправки SMS администратору: ' . $new_result_error . '<br>';
					} else {
						$message_to_myemail .= 'Результат отправки SMS администратору: ' . $new_result . '<br>';
					}
				}

				// Отправка SMS покупателю
				if ($turbosms_client_status == '1') {

					// Получаем количество доступных кредитов
					$credit_result = $client->GetCreditBalance();
					$client_number = '+';
					$client_number .= preg_replace('/[^0-9]+/', '', $phone);

					// Отправляем сообщение на один номер (покупателю)
					// Номер указывается в полном формате, включая плюс и код страны
					if (intval($credit_result) > 0) {
						$sms_sender = $turbosms_name;
						$sms_sender = mb_convert_encoding($sms_sender, 'UTF-8', mb_detect_encoding($sms_sender));


						$sms = array(
							'sender' => $sms_sender,
							'destination' => $client_number,
							'text' => $client_sms
						);
						$result = $client->SendSMS($sms);

						$new_result_error = $result->SendSMSResult->ResultArray;
						$new_result = $result->SendSMSResult->ResultArray[0];

						if ( ! is_array($new_result_error) ) {
							$message_to_myemail .= 'Результат отправки SMS покупателю: ' . $new_result_error;
						} else {
							$message_to_myemail .= 'Результат отправки SMS покупателю: ' . $new_result;
						}
					}
				}

				// Получаем количество доступных кредитов
				$credit_result = $client->GetCreditBalance();
				$message_to_myemail .= '<br />Остаток на SMS счете: ' . $credit_result->GetCreditBalanceResult .'<br />';
				
				$message_to_myemail .= '<br /><br />SMS-шаблон администратору (TurboSMS): ' . "$admin_sms";				
				$message_to_myemail .= '<br /><br />SMS-шаблон покупателю (TurboSMS): ' . "$client_sms";

			}

		} catch(Exception $e) {
			$message_to_myemail .= 'Ошибка: ' . $e->getMessage() . '<br />';
		}

	}

	if ($smsru_status == '1') {

		// SMS.ru покупателю
		if ($smsru_client_sms != '') {
			$client_sms = replace_shablon($smsru_client_sms);
		}

		// SMS.ru админу
		if ($smsru_admin_sms != '') {
			$admin_sms = replace_shablon($smsru_admin_sms);
		}

		$smsru_number = preg_replace('/[^0-9]+/', '', $smsru_number);
		$admin_sms = mb_convert_encoding($admin_sms, 'UTF-8', mb_detect_encoding($admin_sms));
		
		if ($smsru_name != '') {
			$sms_sender = $smsru_name;
			$sms_sender = mb_convert_encoding($sms_sender, 'UTF-8', mb_detect_encoding($sms_sender));
			$sending_string1 = 'https://sms.ru/sms/send?api_id=' . $smsru_api . '&to=' . $smsru_number . '&text=' .  urlencode($admin_sms) . '&from=' . $sms_sender . '&partner_id=188307';
		} else {
			$sending_string1 = 'https://sms.ru/sms/send?api_id=' . $smsru_api . '&to=' . $smsru_number . '&text=' .  urlencode($admin_sms) . '&partner_id=188307';
		}
		
		$body=file_get_contents($sending_string1);
			list($code,$text) = explode("\n", $body);
			if ($code=="100") {
				$message_to_myemail .= '<br /><br /><hr /><br /><strong>SMS.ru</strong><br /><br />Результат отправки SMS администратору: ' . $text;
			} else {
				$message_to_myemail .= '<br /><hr /><strong>SMS.ru</strong><br /><span style="color:#ff0000;">Ошибка отправки SMS администратору:</span> ' . $code;
			}

		// Отправка SMS покупателю
		if ($smsru_client_status == '1') {

			$client_number = preg_replace('/[^0-9]+/', '', $phone);
			$client_sms = mb_convert_encoding($client_sms, 'UTF-8', mb_detect_encoding($client_sms));
			if (isset($smsru_name)) {
				$sms_sender = $smsru_name;
				$sms_sender = mb_convert_encoding($sms_sender, 'UTF-8', mb_detect_encoding($sms_sender));
				$sending_string2 = 'https://sms.ru/sms/send?api_id=' . $smsru_api . '&to=' . $client_number . '&text=' . urlencode($client_sms) . '&from=' . $sms_sender . '&partner_id=188307';
			} else {
				$sending_string2 = 'https://sms.ru/sms/send?api_id=' . $smsru_api . '&to=' . $client_number . '&text=' . urlencode($client_sms) . '&partner_id=188307';
			}
			$body=file_get_contents($sending_string2);
			list($code,$text) = explode("\n", $body);
			if ($code=="100") {
				$message_to_myemail .= '<br />Результат отправки SMS покупателю: ' . $text;
			} else {
				$message_to_myemail .= '<br /><span style="color:#ff0000;">Ошибка отправки SMS покупателю:</span> ' . $code;
			}
		}

		// Получаем количество доступных кредитов
		$sending_string = 'https://sms.ru/my/balance?api_id=' . $smsru_api;
		$body=file_get_contents("$sending_string");

		list($code,$balance) = explode("\n", $body);
		if ($code=="100") {
			$message_to_myemail .= '<br />Остаток на SMS счете: ' . $balance;
		} else {
			$message_to_myemail .= '<br />Ошибка запроса баланса: ' . $code;
		}
		
		$message_to_myemail .= '<br /><br />SMS-шаблон администратору (SMS.ru): ' . "$admin_sms";
		$message_to_myemail .= '<br /><br />SMS-шаблон покупателю (SMS.ru): ' . "$client_sms";

	}
	// Создаем from email
	$from_email = $shop_name . ' <' . $myemail . '>';

	// Создаем заголовок для отправки писем без файла
	$headers = 'Content-type: text/html; charset=UTF-8' . " \r\n" . 'From:' . $from_email . " \r\n";

	// Отправка почты
	$subject = "$shop_name: новый заказ";

	// Отправляем сообщение, используя mail() функцию
	mail($myemail, '=?utf-8?B?'.base64_encode($subject).'?=', $message_to_myemail, $headers);

}else{
	die('spam!');
}

?>