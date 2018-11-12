<?php

/**
 * https://www.unisender.com/ru/support/api/api/#contacts
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Contacts extends Unisender
{
    /**
     * Метод для получения перечня всех имеющихся списков рассылок.
     *
     * @return void
     */
    public function getLists()
    {
        $method = 'getLists';
        $data = [];

        $res = $this->send($data, $method);

        return $res;
    }

    /**
     * Метод для создания нового списка контактов.
     *
     * @param string $title
     * @param string $before_subscribe_url
     * @param string $after_subscribe_url
     * @return void
     */
    public function createList($title, $before_subscribe_url = null, $after_subscribe_url = null)
    {
        $method = 'createList';
        $data['title'] = $title;
        $data['before_subscribe_url'] = $before_subscribe_url;
        $data['after_subscribe_url'] = $after_subscribe_url;

        $res = $this->send($data, $method);

        return $res;
    }

    /**
     * Обновление листа рассылки
     *
     * @param integer $id
     * @param string $title
     * @param string $before_subscribe_url
     * @param string $after_subscribe_url
     * @return void
     */
    public function updateList(int $id, string $title, $before_subscribe_url, $after_subscribe_url)
    {
        $method = 'updateList';

        $data['list_id'] = $id;
        $data['title'] = $title;
        $data['before_subscribe_url'] = $before_subscribe_url;
        $data['after_subscribe_url'] = $after_subscribe_url;

        $res = $this->send($data, $method);

        return $res;
    }

    /**
     * Метод для удаления списка.
     * будут утеряны данные о дате и вермени подписки адресатов на этот список.
     * Те адресаты, которые состояли только в этом списке, и более ни в каких других,
     * после удаления будут отображаться в разделе «вне списков» в веб-интерфейсе.
     *
     * @param integer $id
     * @return void
     */
    public function deleteList(int $id)
    {
        $method = 'deleteList';

        $data['list_id'] = $id;

        $res = $this->send($data, $method);
    }
}