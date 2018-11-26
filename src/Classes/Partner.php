<?php
/**
 * https://www.unisender.com/ru/support/api/api/#partners
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Partner extends Unisender
{
    /**
     * Метод возвращает объект с подтвержденными и неподтвержденными адресами отправителя.
     *
     * @param string $login - Логин пользователя, для которого осуществляется проверка
     * @param string $email - Задается для получения статуса подтверждения по указанному
     * адресу (задавать можно только один адрес).
     * @return void
     */
    public function getCheckedEmail(string $login, string $email = '')
    {
        $method = 'getCheckedEmail';
        $data['login'] = $login;
        if($email != ''){
            $data['email'] = $email;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод отправляет по адресу email письмо со ссылкой на подтверждение адреса в качестве обратного.
     *
     * @param string $email - E-mail адрес, который вы хотите подставлять в поле «От кого» рассылаемых писем.
     * @param string $login - Логин пользователя, которому будет разрешено использовать обратный адрес
     * @return void
     */
    public function validateSender(string $email, string $login = '')
    {
        $method = 'validateSender';
        $data['email'] = $email;
        if($login != ''){
            $data['login'] = $login;
        }

        $res = $this->send($data, $method);
        return $res;
    }
}