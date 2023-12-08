<?php
$userAgent = ($_SERVER["HTTP_USER_AGENT"] ?? "StormGuardian/1.0 (Windows NT 10.0; Win64; x64)");
$key = md5($userAgent);

class Crypt {

    public function encrypt($text):string {
        global $key;

        $encryptedText = "";
        $textLength = strlen($text);
        $keyLength = strlen($key);

        for ($i = 0; $i < $textLength; $i++) {
            $encryptedText .= $text[$i] ^ $key[$i % $keyLength];
        }

        return base64_encode($encryptedText);
    }

    public function decrypt($text):string {
        global $key;

        $encryptedText = base64_decode($text);
        $decryptedText = "";
        $textLength = strlen($encryptedText);
        $keyLength = strlen($key);

        for ($i = 0; $i < $textLength; $i++) {
            $decryptedText .= $encryptedText[$i] ^ $key[$i % $keyLength];
        }

        return $decryptedText;
    }
}