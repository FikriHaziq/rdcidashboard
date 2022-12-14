<?php

namespace App\Http\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

trait LoginApi
{
    public function authenticate($username, $password)
    {
        $publicKey = $this->getPublicKey();
        $encrpyted_password = "";
        openssl_public_encrypt($password, $encrpyted_password, $publicKey);

        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(env('UTM_HOST') . '/login', [
            'username' => $username,
            'password' => base64_encode($encrpyted_password),
        ]);
        return $res;
    }

    public function getPublicKey()
    {
        $res = Http::get(env('UTM_HOST') . '/key?header=1');
        return $res["publicKey"];
    }
    
    public function getClaims($token)
    {
        return Http::withToken($token)->get(env('UTM_HOST'))->json();
    }
}
