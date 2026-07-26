<?php

namespace App\Services;

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class CognitoService
{
    protected $client;

    public function __construct()
    {
        $this->client = new CognitoIdentityProviderClient([
            'version' => 'latest',
            'region' => env('COGNITO_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    public function getClient()
    {
        return $this->client;
    }

    private function secretHash($username)
    {
        return base64_encode(
            hash_hmac(
                'sha256',
                $username . env('COGNITO_CLIENT_ID'),
                env('COGNITO_CLIENT_SECRET'),
                true
            )
        );
    }

    public function register($name, $email, $password)
    {
        return $this->client->signUp([
            'ClientId' => env('COGNITO_CLIENT_ID'),
            'SecretHash' => $this->secretHash($email),
            'Username' => $email,
            'Password' => $password,
            'UserAttributes' => [
                [
                    'Name' => 'name',
                    'Value' => $name,
                ],
                [
                    'Name' => 'email',
                    'Value' => $email,
                ],
            ],
        ]);
    }

    public function verifyUser($email, $code)
    {
        return $this->client->confirmSignUp([
            'ClientId' => env('COGNITO_CLIENT_ID'),
            'SecretHash' => $this->secretHash($email),
            'Username' => $email,
            'ConfirmationCode' => $code,
        ]);
    }

    public function login($email, $password)
    {
        return $this->client->initiateAuth([
            'AuthFlow' => 'USER_PASSWORD_AUTH',
            'ClientId' => env('COGNITO_CLIENT_ID'),
            'AuthParameters' => [
                'USERNAME' => $email,
                'PASSWORD' => $password,
                'SECRET_HASH' => $this->secretHash($email),
            ],
        ]);
    }
}