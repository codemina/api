<?php


namespace CodeMina\Api;

/**
 * Class CmSms
 *
 * @property string $_token
 * @property string $_api
 */
class CmSms
{
    /** @var string  */
    private $_token = null;

    /** @var string  */
    private $_api = 'https://www.codemina.com/api/smsapi';

    /** @var CmMessage */
    private $_message = null;

    /**
     * CmSms constructor.
     * @param string|null $token
     * @param CmMessage|null $message
     */
    public function __construct($token = null, CmMessage $message = null)
    {
        $this->_token = $token;
        $this->_message = $message;
    }

    /**
     * @return CmSms
     */
    public static function getInstance()
    {
        return new CmSms();
    }

    public function setToken($token)
    {
        $this->_token = $token;
    }

    public function setMessage(CmMessage $message)
    {
        $this->_message = $message;
    }

    /**
     * @return mixed
     */
    public function send()
    {
        if ($this->_token == null || $this->_message == null) {
            return false;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_api);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('to' => $this->_message->_to, 'message' => $this->_message->_body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Authorization: ' . $this->_token,
        ));

        $content = curl_exec($ch);
        return json_decode($content);
    }
}