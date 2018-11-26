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

    /**
     * Метод позволяет регистрировать пользователей как реселлерам, так и обычным пользователям.
     *
     * @param string $email - Email-адрес регистрируемого пользователя
     * @param string $login - Логин от 1 до 20 латинских символов и цифр
     * @param string $api_key - Ключ доступа к API текущего пользователя (у пользователя должно быть право reseller)
     * @param integer $need_confirm - подтверждение регистрации (письмо-подтверждение регистрации для нового пользователя),
     * принимает значения 0 и 1. По умолчанию 0 (подтверждение не требуется)
     * @param string $password - Пароль для нового пользователя. Если не указан, то генерируется случайный
     * @param integer $notify - 0 или 1 (по-умолчанию 0) – посылать ли новому пользователю приветственное письмо с паролем
     * @param array $extra - Ассоциативный массив дополнительных полей.
     * Поддерживаются дополнительные поля: ‘firstname’, ‘channel’,
     * если need_confirm = 1 то extra может принимать еще 3-три параметра ‘lastname’, ‘company’, ‘phone’
     * @param string $timezone - Часовой пояс пользователя в формате, который описан здесь:
     * http://php.net/manual/ru/timezones.php.
     * @param string $country_code - Трёхбуквенный код страны по ISO 3166-1 alpha-3 Если не указан,
     * будет установлено значение ‘ZZZ’
     * @param string $currency_code - Трёх буквенный код валюты счёта пользователя.
     * На данный момент возможны RUB, USD, EUR и UAH.
     * @param string $ip - IP-адрес, с которого поступила заявка о регистрации, в формате «NNN.NNN.NNN.NNN»
     * @param integer $test_mode - Тестовое создание пользователя, принимает значения 0 (выкл), 1 (вкл) по умолчанию 0
     * @return void - В случае успешного завершения – объект c одним полем api_key,
     * в котором возвращается ключ для выполнения запросов к API от имени вновь зарегистрированного пользователя.
     * В тестовом режиме всегда возвращается api_key равным 12345678
     */
    public function register(
        string $email,
        string $login,
        string $api_key = '',
        int $need_confirm = 0,
        string $password = '',
        int $notify = 0,
        array $extra = [],
        string $timezone = '',
        string $country_code = '',
        string $currency_code = 'RUB',
        string $ip = '',
        int $test_mode = 0
    )
    {
        $method = 'register';
        $data['email'] = $email;
        $data['login'] = $login;

        if($api_key != ''){
            $data['api_key'] = $api_key;
        }

        $data['need_confirm'] = $need_confirm;

        if($password != ''){
            $data['password'] = $password;
        }

        $data['notify'] = $notify;

        $data['extra'] = $extra;

        if($timezone != ''){
            $data['timezone'] = $timezone;
        }

        if($country_code != ''){
            $data['country_code'] = $country_code;
        }

        $data['currency_code'] = $currency_code;

        if($ip != ''){
            $data['$ip'] = $ip;
        }

        $data['test_mode'] = $test_mode;


        $res = $this->send($data, $method);
        return $res;
    }
}