<?php
/**
 * https://www.unisender.com/ru/support/api/api/#fields
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Fields extends Unisender
{
    /**
     * Метод для получения перечня пользовательских полей.
     *
     * @return void
     */
    public function getFields()
    {
        $method = 'getFields';
        $data = [];

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для создания нового пользовательского поля, значение которого может быть задано
     * для каждого адресата и его потом можно будет подставлять в письмо.
     *
     * @param string $name - Переменная для подстановки.
     * Также не рекомендуется создавать поле с именем,
     * совпадающим с одним из имён стандартных полей (tags, email, phone, email_status, phone_status и пр.)
     * @param string $type - Тип поля. Возможные варианты:
     *      string — строка;
     *      text — одна или несколько строк;
     *      number — целое число или число с десятичной точкой;
     *      date — дата (поддерживается формат ДД.ММ.ГГГГ, ДД-ММ-ГГГГ, ГГГГ.ММ.ДД, ГГГГ-ММ-ДД);
     *      bool — 1/0, да/нет.
     * @param string $public_name - Название поля. Если не использовать,
     * то будет проведена автоматическая генерация по полю «name».
     * @return void
     */
    public function createField(string $name, string $type = 'string', string $public_name = '')
    {
        $method = 'createField';

        $data['name'] = $name;
        $data['type'] = $type;
        if($public_name != ''){
            $data['public_name'] = $public_name;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для изменения параметров пользовательского поля.
     *
     * @param integer $id - ID изменямого поля
     * @param string $name - Название поля. Должно быть уникальным без учёта регистра.
     * Также не рекомендуется создавать поле с именем, совпадающим с одним из имён стандартных полей
     * (tags, email, phone, email_status, phone_status и пр.)
     * @param string $public_name - Название поля. Название в кабинете для поля «переменная для подстановки».
     * Если не использовать, то будет проведена автоматическая генерация по полю «name».
     * @return void
     */
    public function updateField(int $id, string $name, string $public_name = '')
    {
        $method = 'updateField';

        $data['id'] = $id;
        $data['name'] = $name;
        if($public_name != ''){
            $data['public_name'] = $public_name;
        }

        $res = $this->send($data, $method);
        return $res;
    }
}