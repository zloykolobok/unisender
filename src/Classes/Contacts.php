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

    /**
     * Добавляет контакты (email адрес и/или мобильный телефон) контакта в один или несколько списков,
     * а также позволяет добавить/поменять значения дополнительных полей и меток
     *
     * @param string $list_ids - Перечисленные через запятую коды списков
     * @param array $fields - Ассоциативный массив дополнительных полей. Обязательно должно присутствовать
     * хотя бы поле «email» или «phone», иначе метод возвратит ошибку.
     * В случае наличия и e-mail, и телефона, контакт будет включён и в e-mail, и в SMS списки рассылки.
     * @param string $tags - Перечисленные через запятую метки, которые добавляются к контакту.
     * @param integer $double_optin - Принимает значение 0, 3 или 4.
     * Если 0, то мы считаем, что контакт только высказал желание подписаться, но ещё не подтвердил подписку.
     * В этом случае контакту будет отправлено письмо-приглашение подписаться.
     * Текст письма будет взят из свойств первого списка из list_ids.
     * Кстати, текст можно поменять с помощью метода updateOptInEmail или через веб-интерфейс.
     * Если 3, то также считается, что у Вас согласие контакта уже есть, контакт добавляется со статусом «новый».
     * Если 4, то система выполняет проверку на наличие контакта в ваших списках.
     * Если контакт уже есть в ваших списках со статусом «новый» или «активен»,
     * то адрес просто будет добавлен в указанный вами список.
     * Если же контакт отсутствует в ваших списках или его статус отличен от «новый» или «активен»,
     * то ему будет отправлено письмо-приглашение подписаться.
     * Текст этого письма можно настроить для каждого списка с помощью метода
     * updateOptInEmail или через веб-интерфейс.
     * @param integer $overwrite - Режим перезаписывания полей и меток, число от 0 до 2 (по умолчанию 0).
     * Задаёт, что делать в случае существования контакта (контакт определяется по email-адресу и/или телефону).
     * Если 0 — происходит только добавление новых полей и меток, уже существующие поля сохраняют своё значение.
     * Если 1 — все старые поля удаляются и заменяются новыми, все старые метки также удаляются и заменяются новыми.
     * Если 2 — заменяются значения переданных полей, если у существующего контакта есть и другие поля,
     * то они сохраняют своё значение. В случае передачи меток они перезаписываются, если же метки не передаются, то сохраняются старые значения меток.
     * @return void
     */
    public function subscribe(string $list_ids, array $fields, string $tags, int $double_optin=0, int $overwrite=0)
    {
        $method = 'subscribe';

        $data['list_ids'] = $list_ids;
        $data['fields'] = $fields;
        $data['tags'] = $tags;
        $data['double_optin'] = $$double_optin;
        $data['overwrite'] = $$double_optin;

        $res = $this->send($data, $method);
    }

    /**
     * Метод исключает e-mail или телефон контакта из одного или нескольких списков.
     * В отличие от метода unsubscribe, он не помечает контакт как «отписавшийся»,
     * и его позднее снова можно включить в список с помощью метода subscribe.
     *
     * @param string $contact_type - Тип исключаемого контакта — либо 'email', либо 'phone'.
     * @param string $contact - E-mail или телефон, который исключаем.
     * @param string $list_ids - Перечисленные через запятую коды списков.
     * @return void
     */
    public function exclude(string $contact_type, string $contact, string $list_ids)
    {
        $method = 'exclude';

        $data['contact_type'] = $contact_type;
        $data['contact'] = $contact;
        $data['list_ids'] = $list_ids;

        $res = $this->send($data, $method);
    }

    /**
     * Метод отписывает e-mail или телефон контакта от одного или нескольких списков.
     * В отличие от метода exclude, он не исключает при этом контакт из списков,
     * а помечает контакт как «отписавшийся». Вернуть статус на «активный» через API нельзя – это может сделать
     * только сам контакт, перейдя по ссылке активации из письма.
     *
     * @param string $contact_type - Тип исключаемого контакта — либо 'email', либо 'phone'.
     * @param string $contact - E-mail или телефон, который исключаем.
     * @param string $list_ids - $list_ids - Перечисленные через запятую коды списков.
     * @return void
     */
    public function unsubscribe(string $contact_type, string $contact, string $list_ids)
    {
        $method = 'unsubscribe';

        $data['contact_type'] = $contact_type;
        $data['contact'] = $contact;
        $data['list_ids'] = $list_ids;

        $res = $this->send($data, $method);
    }

    /**
     * Метод массового импорта контактов.
     * Может использоваться также для периодической синхронизации с базой контактов,
     * хранящейся на вашем собственном сервере
     * Импортировать можно данные не более 500 контактов за вызов.
     *
     * @param array $field_names - Массив названий столбцов данных.
     * Обязательно должно присутствовать хотя бы поле «email» или «phone». См. https://www.unisender.com/ru/support/api/contacts/importcontacts/
     * @param array $contacts - Массив данных контактов,
     * каждый элемент которого — массив полей в том порядке, в котором следуют field_names.
     * @param integer $overwrite_tags - Перезаписываются ли метки (если 1),
     * или только добавляются новые, не удаляя старых (если 0).
     * @param integer $overwrite_lists - Единица означает — заменить на новые все данные.
     * @return void
     */
    public function importContacts(array $field_names, array $contacts, int $overwrite_tags = 0, int $overwrite_lists = 0)
    {
        $method = 'importContacts';

        $data['field_names'] = $field_names;
        $data['data'] = $contacts;
        $data['overwrite_tags'] = $overwrite_tags;
        $data['overwrite_lists'] = $overwrite_tags;

        $res = $this->send($data, $method);
    }

    /**
     * Экспорт данных контактов из UniSender
     *
     * @param string $list_id - Необязательный код экспортируемого списка.
     * @param array $field_names - Массив названий полей, которые надо экспортировать.
     * Если отсутствует, то экспортируются все возможные поля.
     * @param string $email - E-mail адрес.
     * Если этот параметр указан, то результат будет содержать только один контакт с таким e-mail адресом.
     * @param string $phone - Номер телефона.
     * Если этот параметр указан, то результат будет содержать только один контакт с таким номером телефона.
     * @param string $tag - Если этот параметр указан, то при поиске будут учтены только контакты, имеющие такую метку.
     * @param string $email_status - Статус e-mail адреса.
     * @param string $phone_status - Статус телефона.
     * @param integer $limit - количество экспортируемых контактов
     * @param integer $offset - номер первого экспортируемого контакта
     * @return void
     */
    public function exportContacts(
        string $list_id = '',
        array $field_names = null,
        string $email = '',
        string $phone = '',
        string $tag = '',
        string $email_status = '',
        string $phone_status = '',
        int $limit = 1000,
        int $offset = 0)
    {
        $method = 'exportContacts';
        if($list_id !== ''){
            $data['list_id'] = $list_id;
        }

        if($field_names != null){
            $data['field_names'] = $field_names;
        }

        if($email !== ''){
            $data['email'] = $email;
        }

        if($phone !== ''){
            $data['email'] = $email;
        }

        if($tag !== ''){
            $data['tag'] = $tag;
        }

        if($email_status !== ''){
            $data['email_status'] = $email_status;
        }

        if($phone_status !== ''){
            $data['phone_status'] = $phone_status;
        }

        $data['limit'] = $limit;
        $data['offset'] = $offset;

        $res = $this->send($data, $method);
    }

    /**
     * Возвращает размер базы контактов по логину пользователя
     *
     * @param string $login - Логин пользователя в системе
     * @return void
     */
    public function getTotalContactsCount(string $login)
    {
        $method = 'getTotalContactsCount';

        $data['login'] = $login;

        $res = $this->send($data, $method);
    }

    /**
     * Получаем количество контактов
     *
     * @param string $list_id - id списка, по которому осуществляется поиск
     * @param array $params - список параметров для поиска (хотя бы один параметр)
     * params[tagId] - поиск по тегу с определенным id (можно получить с помощью метода getTags)
     * params[type] - поиск по определенному типу контактов, возможные значения — «adress» либо «phone»
     * params[search] - поиск в email/телефоне по подстроке. Используется только с заданным params[type]
     * @return void
     */
    public function getContactCount(string $list_id, array $params)
    {
        $method = 'getContactCount';

        $data['list_id'] = $list_id;
        $data['params'] = $params;

        $res = $this->send($data, $method);
    }
}