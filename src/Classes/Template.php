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

}