<?php

namespace Zloykolobok\Unisender;

use Zloykolobok\Unisender\Exception\UnisenderException;


class Unisender
{
    protected $url;
    protected $key = null;
    protected $lang = null;
    protected $method;
    protected $timeout;

    public function __construct()
    {
        $this->url = 'https://api.unisender.com';
        $this->timeout = 60;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    protected function getKey()
    {
        return $this->key;
    }

    protected function checkKey()
    {
        if($this->key == null or $this->key == ''){
            throw new UnisenderException('No key for unisender');
        }
    }

    public function setLang($lang = 'ru')
    {
        $this->lang = $lang;
    }

    protected function getLang()
    {
        return $this->lang;
    }

    protected function checkLang()
    {
        if($this->lang == null or $this->lang == ''){
            throw new UnisenderException('No lang for unisender');
        }
    }

    protected function getTimeout()
    {
        return $this->timeout;
    }

    protected function send($data,$method)
    {
        $this->checkKey();
        $this->checkLang();

        $url = $this->url.'/'.$this->lang.'/api/'.$method.'?format=json';

        $array = $data;
        $array['api_key'] = $this->getKey();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->getTimeout());
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);

        if ($res) {
            $jsonObj = json_decode($res);
            if(null===$jsonObj) {
                throw new UnisenderException("Invalid JSON");
            } elseif(!empty($jsonObj->error)) {
                throw new UnisenderException("An error occured: " . $jsonObj->error . "(code: " . $jsonObj->code . ")");
            } else {
                return $res;
            }

        } else {
            throw new UnisenderException('API error');
        }
    }
}