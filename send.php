<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;

require __DIR__ . "/vendor/form.php";

$number = $_POST["number"];
$message = $_POST["message"];

if ($_POST["provider"] === "infobip") {

    $base_url = "https://5y2wwz.api.infobip.com";
    $api_key = "6233b2e456be3fff479b642971815b81-f93ff2a4-e4f3-45ed-9a38-cafbe31b3519";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);

    $api = new SmsApi(config: $configuration);

    $destination = new SmsDestination(to: $number);

    $message = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "daveh"
    );

    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    $response = $api->sendSmsMessage($request);

} else {   // Twilio

    $account_id = "AC22467e856c73a00ee450ade49dc9d083";
    $auth_token = "46e8968c3b69206d835b8fcfa5dffbeb";

    $client = new Client($account_id, $auth_token);

    $twilio_number = "+ your outgoing Twilio phone number";

    $client->messages->create(
        $number,
        [
            "from" => $twilio_number,
            "body" => $message
        ]
    );

}

echo "Message sent.";