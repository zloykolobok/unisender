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

    public function send($data,$method)
    {
        $this->checkKey();
        $this->checkLang();

        $url = $this->url.'/'.$this->lang.'/api/'.$method.'?format=json&api_key='.$this->key;
    }
}