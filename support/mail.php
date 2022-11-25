<?php

function send_email(
	string $recipientName,
	string $recipientEmail,
	string $subject,
	string $body,
): bool {
	$body = json_encode([
		"Messages" => [
			[
				"From" => [
					"Email" => "vacancee@guus.tech",
					"Name" => "Vacancee"
				],
				"To" => [
					[
						"Email" => $recipientEmail,
						"Name"  => $recipientName,
					]
				],
				"Subject" => $subject,
				"TextPart" => $body
			]
		]
	]);

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
	curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Content-Length: ' . strlen($body),
		'Authorization: Basic ' . base64_encode(get_env_or_die("MAILJET_API_KEY") . ":" . get_env_or_die("MAILJET_SECRET_KEY"))
	]);

	$response = curl_exec($curl);

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	return substr(strval($status), 0, 1) == 2;
}