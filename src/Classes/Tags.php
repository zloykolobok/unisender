<?php
/**
 * https://www.unisender.com/ru/support/api/api/#fields
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Tags extends Unisender
{
    /**
     * Метод для получения пользовательских меток.
     *
     * @return void
     */
    public function getTags()
    {
        $method = 'getTags';
        $data = [];

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для удаления пользовательской метки.
     *
     * @param integer $id - Код одной из меток
     * @return void
     */
    public function deleteTag(int $id)
    {
        $method = 'deleteTag';
        $data['id'] = $id;

        $res = $this->send($data, $method);
        return $res;
    }
}