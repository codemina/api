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
    private $_token = '';

    /** @var string  */
    private $_api = 'https://www.codemina.com/api/smsapi';

    /** @var CmMessage */
    private $_message;

    public function __construct($token, CmMessage $message)
    {
        $this->_token = $token;
        $this->_message = $message;
    }

    /**
     * @return mixed
     */
    public function send()
    {
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