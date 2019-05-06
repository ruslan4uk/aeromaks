<?php
header('Content-Type: text/html; charset=utf-8');

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	$to = 'rusel91@idz.ru';  // Укажи здесь нужный ящик

	// тема письма
	$subject = 'Новое действие на сайте';

	if($_REQUEST['hidden'] != ''){
        $error = false;
		if(isset($_REQUEST['hidden'])) {$hidden = $_REQUEST['hidden'];} else {$hidden = ' ';}
		if(isset($_REQUEST['subject'])) {$subject = $_REQUEST['subject'];} else {$subject = ' ';}
		if(isset($_REQUEST['name'])) {$name = $_REQUEST['name'];} else {$name = ' ';}
		if(isset($_REQUEST['email'])) {$email = $_REQUEST['email'];} else {$email = ' ';}
		if(isset($_REQUEST['message'])) {$message = $_REQUEST['message'];} else {$message = ' ';}
		$body = "Заявка с сайта:<br/>
		Имя: " . $name ."
        <br/>E-mail: " . $email ."
        <br/>Тема: " . $subject ."
        <br/>Сообщение: " . $message ."
		<br/>IP: " . $_SERVER["REMOTE_ADDR"] ."
		<br/>Форма: " . $hidden;
	}else{
        $error = true;
	}

	// текст письма
	$message = '
	<html>
	<head>
	  <title>Новое действие на Вашем сайте</title>
	</head>
	<body>
	  <h1>Новое действие на Вашем сайте</h1>

	  <p>' . $body . '</p>
	</body>
	</html>
	';

	// Для отправки HTML-письма должен быть установлен заголовок Content-type
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	// Дополнительные заголовки
	$headers .= 'From: Site Support <support@aeromaks.ru/>' . "\r\n";

	if(mail($to, $subject, $message, $headers) && !$error){
        return http_response_code(200);
	}else{
        return http_response_code(400);
	}

}
?>