<?php
namespace MyLittleBiz;

/**
 * Client
 */
class Client
{
    private $baseUrl = "https://customers.mylittlebiz.fr/api/1.1/";

    protected $api_key;

    protected $api_secret;

    public $request;
    
    public $errorMessage;

    /**
     * construct
     */
    public function __construct($api_key = null, $api_secret = null)
    {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }

    /**
     * @param {string} $api_key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * @param {string} $api_secret
     */
    public function setApiSecret($api_secret)
    {
        $this->api_secret = $api_secret;
        return $this;
    }

    public function check()
    {
        return $this->request('GET', 'check');
    }


    /**
     * @param type $ApiToken
     */
    public function setApiToken($ApiToken)
    {
        $this->ApiToken = $ApiToken;
        return $this;
    }

    public function Campaign()
    {
        return new Rest\Campaign($this);
    }

    public function Contact()
    {
        return new Rest\Contact($this);
    }

    public function ContactGroup()
    {
        return new Rest\ContactGroup($this);
    }

    public function Template()
    {
        return new Rest\Template($this);
    }

    public function TemplateGroup()
    {
        return new Rest\TemplateGroup($this);
    }

    public function request($method = 'GET', $uri = '', array $params = [], $data = null)
    {
        $client = new \GuzzleHttp\Client([
                'base_uri' => $this->baseUrl, 
                'http_errors' => false
            ]);

        $params = array_merge(
                $params,
                [
                    'api_key'    => $this->api_key,
                    'api_secret' => $this->api_secret,
                ]
            );

        try {
            $this->request = $client->request($method, $uri, ['query' => $params, 'form_params' => $data]);
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }

        return json_decode($this->request->getBody()->getContents(), 1);
        // // 200
        // echo $res->getHeaderLine('content-type');
        // // 'application/json; charset=utf8'
        // echo $res->getBody();
        // // '{"id": 1420053, "name": "guzzle", ...}'
    }
}