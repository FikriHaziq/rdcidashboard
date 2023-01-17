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
            // 'username' => 'ma.fateh',
            // 'password' => 'bHCuvG3oNVC6Qt6gbUt69ycW8dFZ7RyqAPhD7NgMrXI4X+6LzQt5lI7L90YsXPzLaz6tZSUgUvEUr75Law38QRfsp7xtUJAnd2BQhdz4N6JkEt03JAj56m9fe6VQdrrdsEdlmetIGARAMC2kLC9XTTXVhG0tNLZlsrBsgVV6pap6Rsr4WxHOu3zX4Wl8R0E6A2RLq/GPwRqyk4pV3T1GBdho3YKtTxF2dLeBvA4aj9oPMaP2O5zQj6V+hPJjtDzeSBQjSIeAafZ4NuRAZ68S6DHRbq3C5uRB740mBkel4CBRSeLQib53AfF1Mi5peKPKR2IvONuXaZACAap5cRm2Tw==',
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
