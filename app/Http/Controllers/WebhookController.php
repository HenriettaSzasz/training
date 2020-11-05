<?php

namespace App\Http\Controllers;

use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handleWebhook()
    {
        $endpoint_secret = 'whsec_lA95MhhILTOfq7N171lnXO1vzNHCSkcb';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        }catch (\UnexpectedValueException $e){
            http_response_code(400);
        }catch (SignatureVerificationException $e){
            http_response_code(400);
            exit();
        }

        if($event->type === "payment_intent.succeeded"){
            $intent = $event->data->object;

            printf("Succeeded: %s", $intent->id);
            http_response_code(200);
            exit();
        }elseif ($event->type == "payment_intent.payment_failed"){
            $intent = $event->data->object;
            $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : null;
            printf("Failed: %s, %s", $intent->id, $error_message);
            http_response_code(200);
            exit();
        }
    }
}
