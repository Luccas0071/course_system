<?php

namespace App\Generic;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;

class Generic
{

    public static function extractMessagesFromMessageBag(MessageBag $messageBag): array
    {
        $messages = Array();

        $errorArray = $messageBag->toArray();

        foreach ($errorArray as $error) {
            foreach ($error as $content) {
                $messages[] = $content;
            }
        }

        return ['message' => $messages];
    }

    public static function message($success, $message, $data = null, $errorCode = null, $dataValidation = null): JsonResponse
    {
        if (is_string($message)) {
            $messageArray = ['message' => [$message]];
        } elseif (is_array($message)) {
            $messageArray = ['message' => $message['message']];
        } else {
            $messageArray = ['message' => []];
        }
        
        return response()->json([
            'success' => $success,
            'message' => $messageArray['message'],
            'data' => $data,
            'code' => $errorCode
        ]);
    }
}