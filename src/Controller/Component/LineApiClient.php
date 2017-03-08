<?php

namespace App\Controller\Component;

use Cake\Core\Configure;
use Cake\Http\Client;

const API_BASE_URL = 'https://api.line.me';
const ACCESS_TOKEN_API_PATH = '/v2/oauth/accessToken';
const PROFILE_API_PATH = '/v2/profile';

class LineApiClient
{
    public static function getAccessToken($code)
    {
        $data = array('grant_type' => 'authorization_code',
            'client_id' => Configure::read('channel.channelId'),
            'client_secret' => Configure::read('channel.channelSecret'),
            'code' => $code,
            'redirect_uri' => Configure::read('channel.callbackUrl'));
        $client = new Client();
        $response = $client->post(API_BASE_URL . ACCESS_TOKEN_API_PATH, $data);
        return json_decode($response->getBody());
    }

    public static function getProfile($accessToken)
    {
        $options = array('headers' => ['Authorization' => 'Bearer {' . $accessToken . '}']);
        $client = new Client();
        $response = $client->get(API_BASE_URL . PROFILE_API_PATH, [], $options);
        return json_decode($response->getBody());
    }
}
