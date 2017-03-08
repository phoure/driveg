<?php

namespace App\Controller;

use App\Controller\Component\LineApiClient;
use Cake\Core\Configure;
use Cake\Log\Log;

class WebController extends AppController
{
    public function index()
    {
        $this->viewBuilder()->setLayout(false);
        $this->set('loginUrl', '/login');
    }

    public function login()
    {
        // redirect
        $url = 'https://access.line.me/dialog/oauth/weblogin?response_type=code'
            . '&client_id=' . Configure::read("channel.channelId")
            . '&redirect_uri=' . Configure::read("channel.callbackUrl");
        $this->redirect($url);
    }

    public function callback()
    {
        $code = $this->request->getQuery('code');
        // get access token
        $response = LineApiClient::getAccessToken($code);
        Log::debug($response);
        // save access token
        $session = $this->request->session();
        $session->write('access_token', $response->access_token);
        $this->redirect('/web/loggedIn');
    }

    public function loggedIn()
    {
        $this->viewBuilder()->setLayout(false);
        $session = $this->request->session();

        if (!$session->check('access_token')) {
            $this->redirect('/web');
        }
        $accessToken = $session->read('access_token');
        // get profile
        $response = LineApiClient::getProfile($accessToken);
        Log::debug($response);
        $this->set('userId', $response->userId);
        $this->set('displayName', $response->displayName);
        $this->set('pictureUrl', $response->pictureUrl);
        $this->set('statusMessage', $response->statusMessage);
    }

    public function logout()
    {
        $this->request->session()->destroy();
        $this->redirect('/web');
    }
}
