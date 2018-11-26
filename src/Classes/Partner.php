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
}