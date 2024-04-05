<?php

class SecretService
{
    private $encryptKey;

    public function __construct()
    {
        Environment::loadEnv();
        $this->encryptKey = Environment::get('ENCRYPT_KEY');
    }

    public function encrypt($secret, $secretVerify)
    {
        $verifyMathResult = $this->verifyMath($secret, $secretVerify);
        if (!$verifyMathResult) {
            return $this->handleFailure(ErrorMessage::SecretNotMath);
        }

        $verifySizeResult = $this->verifySize($secret);
        if (!$verifySizeResult) {
            return $this->handleFailure(ErrorMessage::SecretSize);
        }

        $verifyUppercaseResult = $this->verifyUppercase($secret);
        if (!$verifyUppercaseResult) {
            return $this->handleFailure(ErrorMessage::SecretUppercase);
        }

        $verifySpecialCharacterResult = $this->verifySpecialCharacter($secret);
        if (!$verifySpecialCharacterResult) {
            return $this->handleFailure(ErrorMessage::SecretSpecial);
        }

        $encryptPassword = $this->hashPassword($this->plusEncryptKey($secret));
        return $this->handleSuccess($encryptPassword);
    }

    public function verifyPassword($secret, $hashedSecret)
    {
        if (password_verify($this->plusEncryptKey($secret), $hashedSecret)) {
            return $this->handleSuccess(true);
        } else {
            return $this->handleFailure(ErrorMessage::SecretNotMath);
        }
    }

    private function hashPassword($secret)
    {
        return password_hash($secret, PASSWORD_DEFAULT);
    }

    private function plusEncryptKey($secret)
    {
        return $secret . $this->encryptKey;
    }

    private function verifyMath($secret, $secretVerify)
    {
        return $secret === $secretVerify;
    }

    private function verifySize($secret)
    {
        $minSize = SecretRules::Size;
        $maxSize = SecretRules::MaxSize;
        $length = strlen($secret);
        return ($length >= $minSize && $length <= $maxSize);
    }

    private function verifyForbiddenChars($secret)
    {
        $forbiddenChars = str_split(SecretRules::WithoutChars);
        foreach ($forbiddenChars as $char) {
            if (strpos($secret, $char) !== false) {
                return false;
            }
        }
        return true;
    }

    private function verifyUppercase($secret)
    {
        return preg_match('/[A-Z]/', $secret);
    }

    private function verifySpecialCharacter($secret)
    {
        $specialChars = str_split(SecretRules::MustHaveChar);
        foreach ($specialChars as $char) {
            if (strpos($secret, $char) !== false) {
                return true;
            }
        }
        return false;
    }

    private function handleSuccess($data)
    {
        return ['success' => true, 'data' => $data];
    }

    private function handleFailure($error)
    {
        return ['success' => false, 'error' => $error];
    }
}

class ErrorMessage
{
    const SecretNotMath = "SecretNotMath";
    const SecretSize = "SecretSize";
    const SecretWithoutChars = "SecretWithoutChars";
    const SecretUppercase = "SecretUppercase";
    const SecretSpecial = "SecretSpecial";
}

class SecretRules
{
    const Size = 8;
    const MaxSize = 20;
    const WithoutChars = "!@#$%^&*()";
    const MustHaveChar = "!@#$%^&*()";
}
