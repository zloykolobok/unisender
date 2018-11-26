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

    /**
     * Проверяет, зарегистрирован ли пользователь с заданым login или email.
     * Предназначен для вызова только реселлерами.
     *
     * @param string $login - Проверяемый логин пользователя.
     * @param string $email - Проверяемый email-адрес пользователя.
     * @return void - json-обект с двумя полями: «login_exists» и «email_exists»,
     * имеющим значение 1 если найден пользователь с таким логином или, соответственно, email-адресом.
     * Если пользователь не найден, соответствующее поле принимает значение 0.
     */
    public function checkUserExists(string $login = '', string $email = '')
    {
        $method = 'checkUserExists';
        if($login != ''){
            $data['login'] = $login;
        }

        if($email != ''){
            $data['email'] = $email;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для получения информации о пользователе и состоянии его счёта.
     *
     * @param string $login - Логин пользователя, информацию по которому хочется получить.
     * Игнорируется, если пользователь не имеет статуса реселлера.
     * @return void
     */
    public function getUserInfo(string $login)
    {
        $method = 'getUserInfo';
        $data['login'] = $login;

        $res = $this->send($data, $method);
        return $res;
    }


    /**
     * Метод для получения информации о пользователях прикреплённых к партнёру.
     *
     * @param string $registered_after - Дата и время после которой зарегистрировались пользователи
     * в формате «ГГГГ-ММ-ДД чч:мм».
     * @param string $registered_before - Дата и время до которой зарегистрировались пользователи
     * в формате «ГГГГ-ММ-ДД чч:мм».
     * @return void
     */
    public function getUsers(string $registered_after = '', string $registered_before = '')
    {
        $method = 'getUsers';
        if($registered_after != ''){
            $data['registered_after'] = $registered_after;
        }
        if($registered_before != ''){
            $data['registered_before'] = $registered_before;
        }

        $res = $this->send($data, $method);
        return $res;
    }
}