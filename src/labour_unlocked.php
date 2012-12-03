<?php

/**
 * A helper class to manage URL's for Labour Unlocked 2 (LU2)
 */
class LabourUnlocked
{

    /*
     * These parameters should be configured with details supplied by Tangent
     */
    private $tokenAuthorizeParams = array(
      'client_id' => '1_2990of3rb17o40w8848cck40w0s8ggs4c8ogk00k8w8skg0wwk',
      'client_secret' => '5rbpx3jdnngg848s8k08wwgcskgwckco8sggkwcc0kw4c0wooo',
      'response_type' => 'code',
      'grant_type' => 'token',
      'redirect_uri' => 'http://localhost/unlocked-client/authorise.php',
    );
    private $labourUnlockedHost = "http://labour-unlocked.local";

    /*
     * These parameters are constant for LU2.
     */
    private $authorizeUrl = "/oauth/v2/authorize/";
    private $apiUrl = "/api/code/";
    private $registerUrl = "/register/";
    private $logoutUrl = "/logout";

    /**
     * Get the URL used to access the LU2 API
     *
     * @param string $code The code returned after authorization
     * @return string
     */
    public function getApiUrl($code)
    {
        return sprintf("%s%s%s/", $this->labourUnlockedHost,
                       $this->apiUrl, $code);
     }

    public function getAuthorizeUrl($with_params=true)
    {
        $url = $this->labourUnlockedHost.$this->authorizeUrl;
        if ($with_params) {
            $url .= '?'. http_build_query($this->tokenAuthorizeParams);
        }
        return $url;
    }

    /**
     * Get the URL used to logout of LU2
     *
     * @param string $redirect_url The URL to redirect to after logging out
     * @return string
     */
    public function getLogoutUrl($redirect_url)
    {
        return sprintf("%s%s?redirect_uri=%s", $this->labourUnlockedHost,
                       $this->logoutUrl, $redirect_url);
    }

    /**
     * Get the URL used to register a new user on LU2
     *
     * @return string
     */
    public function getRegisterUrl($redirect_url)
    {
        return sprintf("%s%s?redirect_uri=%s", $this->labourUnlockedHost,
                       $this->registerUrl, $redirect_url);
    }

}