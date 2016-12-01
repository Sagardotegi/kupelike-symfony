<?php

namespace KupelikeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Facebook\Facebook;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use KupelikeBundle\Entity\Cliente;

class ClienteController extends Controller
{
    /**
     * Conectamos con Facebook
     */ 
    public function loginAction()
    {
        $appId = $this->container->getParameter('facebook_app_id');
        $secret = $this->container->getParameter('facebook_app_secret');
        
        // conectamos con facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $secret,
            'default_graph_version' => 'v2.2',
            'persistent_data_handler' => 'session'
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        // permisos
        $permissions = ['email'];
        
        $loginUrl = $helper->getLoginUrl('https://kupelike-edertxodw.c9users.io/web/app_dev.php/check', $permissions);
        
        return $this->redirect($loginUrl);
    }
    
    public function checkAction()
    {
        $appId = $this->container->getParameter('facebook_app_id');
        $secret = $this->container->getParameter('facebook_app_secret');
        
        // conectamos con facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $secret,
            'default_graph_version' => 'v2.2',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }
        
        if (! isset($accessToken)) {
          if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
          }
          exit;
        }
        
        // Logged in
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());
        
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);
        
        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId($appId); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
        
        if (! $accessToken->isLongLived()) {
          // Exchanges a short-lived access token for a long-lived one
          try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
            exit;
          }
        
          echo '<h3>Long-lived</h3>';
          var_dump($accessToken->getValue());
        }
        
        $_SESSION['fb_access_token'] = (string) $accessToken;
    }
}
