<?php


namespace CodeMina\Api;


/**
 * Class CmMessage
 * @property string $_to
 * @property string $_body
 */
class CmMessage extends \stdClass
{
    /**
     * @var string
     * @deprecated
     */
    public $_to = '';

    /**
     * @var string
     * @deprecated
     */
    public $_body = '';

    /**
     * @return CmMessage
     */
    public static function getInstance()
    {
        return new CmMessage();
    }

    /**
     * @param $to
     * @return CmMessage
     */
    public function setTo($to)
    {
        $this->_to = $to;
        return $this;
    }

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->_body = $body;
        return $this;
    }
}