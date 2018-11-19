<?php
/**
 * https://www.unisender.com/ru/support/api/api/#templates
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Template extends Unisender
{
    /**
     * Метод для создания шаблона email письма для массовой рассылки
     *
     * @param string $title - Название шаблона
     * @param string $sender_name - Имя отправителя. Произвольная строка, не совпадающая с email адресом
     * @param string $sender_email - Email адрес отправителя.
     * @param string $subject - Строка с темой письма. Может включать поля подстановки.
     * @param string $body - Текст шаблона письма в формате HTML с возможностью добавлять поля подстановки.
     * @param string $description - Текстовое описание шаблона
     * @param string $list_id - Код списка, для которого по умолчанию создается шаблон.
     * @param string $text_body - Текстовый вариант шаблона письма.
     * @param string $segment_id - Код сегмента, для которого создается шаблон.
     * @param string $tag - Метка. Если задана, то отправка рассылки письма из шаблона будет
     * производиться не по всему списку, а только по тем адресатам, которым присвоена заданная метка.
     * @param string $lang - Двухбуквенный код языка для автоматически добавляемой в каждое письмо строки со ссылкой отписки.
     * @param string $message_format - Определяет способ создания шаблона:
     * «block» — блочный редактор,
     * «raw_html» — html редактор,
     * text — текст.
     * @param string $raw_body - Предназначен для сохранения json структуры структуры данных блочного редактора
     * @return void
     */
    public function createEmailTemplate(
        string $title,
        string $sender_name,
        string $sender_email,
        string $subject,
        string $body,
        string $description = '',
        string $list_id,
        string $text_body = '',
        string $segment_id,
        string $tag,
        string $lang = 'ru',
        string $message_format = 'raw_htm',
        string $raw_body
    )
    {
        $method = 'createEmailTemplate';
        $data['title'] = $title;
        $data['sender_name'] = $sender_name;
        $data['sender_email'] = $sender_email;
        $data['subject'] = $subject;
        $data['body'] = $body;

        if($data['description'] != ''){
            $data['description'] = $description;
        }

        $data['list_id'] = $list_id;

        if($data['text_body'] != ''){
            $data['text_body'] = $text_body;
        }

        $data['segment_id'] = $segment_id;
        $data['tag'] = $tag;
        $data['lang'] = $lang;
        $data['message_format'] = $message_format;
        $data['raw_body'] = $raw_body;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для редактирования шаблона email письма для массовой рассылки
     *
     * @param integer $template_id - Идентификатор шаблона,
     * @param string $title - Название шаблона
     * @param string $sender_name - Имя отправителя. Произвольная строка, не совпадающая с email адресом
     * @param string $sender_email - Email адрес отправителя.
     * @param string $subject - Строка с темой письма. Может включать поля подстановки.
     * @param string $body - Текст шаблона письма в формате HTML с возможностью добавлять поля подстановки.
     * @param string $description - Текстовое описание шаблона
     * @param string $list_id - Код списка, для которого по умолчанию создается шаблон.
     * @param string $text_body - Текстовый вариант шаблона письма.
     * @param string $segment_id - Код сегмента, для которого создается шаблон.
     * @param string $tag - Метка. Если задана, то отправка рассылки письма из шаблона будет
     * производиться не по всему списку, а только по тем адресатам, которым присвоена заданная метка.
     * @param string $lang - Двухбуквенный код языка для автоматически добавляемой в каждое письмо строки со ссылкой отписки.
     * @param string $message_format - Определяет способ создания шаблона:
     * «block» — блочный редактор,
     * «raw_html» — html редактор,
     * text — текст.
     * @return void
     */
    public function updateEmailTemplate(
        int $template_id,
        string $title = '',
        string $sender_name = '',
        string $sender_email = '',
        string $subject = '',
        string $body = '',
        string $description = '',
        string $list_id = '',
        string $text_body = '',
        string $segment_id = '',
        string $tag = '',
        string $lang = 'ru',
        string $message_format = 'raw_htm',
        string $raw_body = ''
    )
    {
        $method = 'updateEmailTemplate';
        $data['template_id'] = $template_id;

        if($data['title'] != ''){
            $data['title'] = $title;
        }

        if($data['sender_name'] != ''){
            $data['sender_name'] = $sender_name;
        }

        if($data['sender_email'] != ''){
            $data['sender_email'] = $sender_email;
        }

        if($data['subject'] != ''){
            $data['subject'] = $subject;
        }

        if($data['body'] != ''){
            $data['body'] = $body;
        }

        if($data['description'] != ''){
            $data['description'] = $description;
        }

        if($data['list_id'] != ''){
            $data['list_id'] = $list_id;
        }

        if($data['text_body'] != ''){
            $data['text_body'] = $text_body;
        }

        if($data['segment_id'] != ''){
            $data['segment_id'] = $segment_id;
        }

        if($data['tag'] != ''){
            $data['tag'] = $tag;
        }

        if($data['lang'] != ''){
            $data['lang'] = $lang;
        }

        if($data['message_format'] != ''){
            $data['message_format'] = $message_format;
        }

        if($data['raw_body'] != ''){
            $data['raw_body'] = $raw_body;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для удаления шаблона.
     *
     * @param integer $template_id - Код шаблона
     * @return void
     */
    public function deleteTemplate(int $template_id )
    {
        $method = 'deleteTemplate';
        $data['template_id'] = $template_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод возвращает информацию о заданном шаблоне.
     *
     * @param integer $template_id - ID шаблона.
     * @param string $format - Формат вывода возвращаемого результата. Может принимать значения html | json
     * @return void
     */
    public function getTemplate(int $template_id, string $format = 'json')
    {
        $method = 'getTemplate';
        $data['template_id'] = $template_id;
        $data['format'] = $format;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Данный метод используется для получения списка всех шаблонов
     *
     * @param string $type - Тип шаблона, принимает значения: system|user;
     * @param string $date_from - Дата и время создания шаблона, начиная с которой нужно выводить шаблоны,
     * в формате «ГГГГ-ММ-ДД чч:мм», часовой пояс UTC.
     * @param string $date_to - Дата и время создания шаблона, заканчивая которой нужно выводить шаблоны,
     *  в формате «ГГГГ-ММ-ДД чч:мм», часовой пояс UTC.
     * @param string $format - Формат вывода возвращаемого результата. Может принимать значения html | json
     * @param integer $limit - Количество записей в ответе на один запрос должно быть целым числом
     * в диапазоне 1 — 100 , по умолчанию стоит 50 записей.
     * @param integer $offset - Параметр указывает, с какой позиции начинать выборку.
     * Значение должно быть 0, или больше (позиция первой записи начинается с 0), по умолчанию 0.
     * @return void
     */
    public function getTemplates(
        string $type = 'user',
        string $date_from = '',
        string $date_to = '',
        string $format = 'json',
        int $limit = 50,
        int $offset = 0
    )
    {
        $method = 'getTemplates';

        $data['type'] = $type;

        if($data['date_from'] != ''){
            $data['date_from'] = $date_from;
        }

        if($data['date_to'] != ''){
            $data['date_to'] = $date_to;
        }

        $data['format'] = $format;
        $data['limit'] = $limit;
        $data['offset'] = $offset;

        $res = $this->send($data, $method);
        return $res;
    }

}