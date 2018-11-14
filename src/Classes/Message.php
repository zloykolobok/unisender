<?php
/**
 * https://www.unisender.com/ru/support/category/api/messages/
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Message extends Unisender
{
    /**
     * Метод для создания e-mail сообщения без отправки.
     * https://www.unisender.com/ru/support/api/messages/createemailmessage/
     *
     * @param string $sender_name - Имя отправителя. Произвольная строка,
     * не совпадающая с e-mail адресом (аргумент sender_email).
     * @param string $sender_email - E-mail адрес отправителя.
     * @param string $subject - Строка с темой письма. Может включать поля подстановки.
     * @param string $body - Текст письма в формате HTML с возможностью добавлять поля подстановки.
     * @param string $list_id - Код списка, по которому будет произведена отправка e-mail рассылки.
     * @param string $text_body - Текстовый вариант письма. По умолчанию отсутствует.
     * @param integer $generate_text - 0 или 1, по умолчанию 0. Значение 1 означает,
     * что генерация текстовой части письма будет выполнена автоматически по HTML-части.
     * @param string $raw_body - Предназначен для сохранения json структуры структуры данных
     * @param string $message_format - Определяет способ создания письма:
     * «block» — блочный редактор, «raw_html» — html редактор, «text» — текст.
     * @param string $tag - Метка. Если задана, то отправка рассылки письма будет производиться
     * не по всему списку, а только по тем адресатам, которым присвоена заданная метка.
     * @param array $attachments - Ассоциативный массив файлов-вложений.
     * @param string $lang - Двухбуквенный код языка для автоматически добавляемой в каждое письмо строки со ссылкой отписки.
     * @param string $template_id - id шаблона письма, созданного ранее, на основе которого можно создать письмо.
     * @param string $wrap_type - Выравнивание текста сообщения по заданному краю.
     * skip (не применять), right (выравнивание по правому краю), left (выравнивание по левому краю), center (выравнивание по центру).
     * @param string $categories - Категории письма, перечисленные в текстовом виде через запятую
     * @return void
     */
    public function createEmailMessage(
        string $sender_name,
        string $sender_email,
        string $subject,
        string $body,
        string $list_id,
        string $text_body = '',
        int $generate_text = 0,
        string $raw_body,
        string $message_format = 'raw_html',
        string $tag = '',
        array $attachments = [],
        string $lang = 'ru',
        string $template_id = '',
        string $wrap_type = 'skip',
        string $categories = ''
    )
    {
        $method = 'createEmailMessage';

        $data['sender_name'] = $sender_name;
        $data['sender_email'] = $sender_email;
        $data['subject'] = $subject;
        $data['body'] = $body;
        $data['list_id'] = $list_id;
        if($text_body != ''){
            $data['text_body'] = $text_body;
        }
        $data['generate_text'] = $generate_text;
        $data['raw_body'] = $raw_body;
        $data['message_format'] = $message_format;
        if($tag != '') {
            $data['tag'] = $message_format;
        }

        foreach ($attachments as $key=>$val){
            $data['attachments['.$key.']'] = $val;
        }

        $data['lang'] = $lang;

        if($template_id != ''){
            $data['template_id'] = $template_id;
        }

        $data['wrap_type'] = $wrap_type;

        if($categories != ''){
            $data['categories'] = $categories;
        }


        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для создания SMS-сообщения без отправки.
     * https://www.unisender.com/ru/support/api/messages/createsmsmessage/
     *
     * @param string  $sender - Имя отправителя от 3 до 11 латинских букв и цифр.
     * Имя необходимо регистрировать в службе поддержки.
     * @param string  $body - Текст сообщения с возможностью добавлять поля подстановки.
     * @param string  $list_id - Код списка, по которому будет отправка SMS.
     * @param string $tag - Метка. Если задана, то отправка сообщения будет производиться не по всему списку,
     * а только по тем адресатам, которым присвоена заданная метка.
     * @param string $series_day - День отправки для автоматически рассылаемого сообщения, входящего в серию.
     * @param string $series_time - Время отправки для автоматически рассылаемого письма в формате «ЧЧ:ММ»
     * @param string $categories - Категории сообщения, перечисленные в текстовом виде через запятую
     * @return void
     */
    public function createSmsMessage(
        string $sender,
        string $body,
        string $list_id,
        string $tag = '',
        string $series_day = '',
        string $series_time = '',
        string $categories = ''
    )
    {
        $method = 'createSmsMessage';

        $data['sender'] = $sender;
        $data['body'] = $body;
        $data['list_id'] = $list_id;

        if($tag != ''){
            $data['tag'] = $tag;
        }

        if($series_day != ''){
            $data['series_day'] = $series_day;
        }

        if($series_time != ''){
            $data['series_time'] = $series_time;
        }

        if($categories != ''){
            $data['categories'] = $categories;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Запланировать или начать немедленно рассылку e-mail или SMS-сообщения.
     * https://www.unisender.com/ru/support/api/messages/createcampaign/
     *
     * @param string $message_id - Код сообщения, которое надо отправить.
     * @param string $start_time - Дата и время запуска рассылки в формате «ГГГГ-ММ-ДД чч:мм».
     * @param string $timezone - Часовой пояс, в котором задано время в аргументе «start_time».
     * @param integer $track_read - Принимаемое значение – 0 или 1 – отслеживать ли факт прочтения e-mail сообщения.
     * @param integer $track_links - Принимаемое значение – 0 или 1 – отслеживать ли переходы по ссылкам в e-mail сообщениях
     * @param string $contacts - Перечисленные через запятую email-адреса (или телефоны для sms-сообщений),
     * которыми нужно ограничиться при отправке сообщения.
     * @param string $contacts_url - Вместо параметра contacts, содержащего собственно email-адреса или телефоны,
     * можно задать в данном параметре URL файла, откуда будут прочитаны адреса (телефоны)
     * @param integer $track_ga - Принимаемое значение – 0 или 1 – включить ли для данной рассылки интеграцию с Google Analytics/Яндекс.Метрика.
     * @param integer $payment_limit - Параметр, позволяющие ограничить бюджет рассылки
     * до заданной в payment_limit суммы в валюте payment_currency
     * @param string $payment_currency - Параметр, позволяющие ограничить бюджет рассылки до заданной в
     * payment_limit суммы в валюте payment_currency
     * @return void
     */
    public function createCampaign(
        string $message_id,
        string $start_time = '',
        string $timezone = '',
        int $track_read = 0,
        int $track_links = 0,
        string $contacts = '',
        string $contacts_url = '',
        int $track_ga = 0,
        int $payment_limit = 0,
        string $payment_currency = 'USD'
        // ga_medium, ga_source, ga_campaign, ga_content, ga_term
    )
    {
        $method = 'createCampaign';

        $data['message_id'] = $message_id;

        if($start_time != ''){
            $data['start_time'] = $start_time;
        }

        if($timezone != ''){
            $data['timezone'] = $timezone;
        }

        $data['track_read'] = $track_read;
        $data['track_links'] = $track_links;

        if($contacts != ''){
            $data['contacts'] = $contacts;
        }

        if($contacts_url != ''){
            $data['contacts_url'] = $contacts_url;
        }

        $data['track_ga'] = $track_ga;
        $data['payment_limit'] = $payment_limit;
        $data['payment_currency'] = $payment_currency;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * В кабинете UniSender реализована версионность писем.
     * Ранее отправленное письмо можно отредактировать,
     * или изменить список отправки, при этом будет создана новая версия письма.
     *
     * @param integer $message_id - Идентификатор сообщения, для которого необходимо получить id актуальной версии письма
     * @return void
     */
    public function getActualMessageVersion(int $message_id )
    {
        $method = 'getActualMessageVersion';
        $data['message_id '] = $message_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для простой отправки одного SMS-сообщения одному или нескольким адресатам.
     * https://www.unisender.com/ru/support/api/messages/sendsms/
     *
     * @param string $phone - Телефон получателя в международном формате с кодом страны (можно опускать ведущий «+»).
     * Можно указывать несколько номеров адресатов через запятую.
     * Максимальное количество номеров за один вызов: 150.
     * @param string $sender - Отправитель –   строка от 3 до 11 латинских букв или цифр с буквами.
     * Также возможны специальные символы – точка, дефис, тире и некоторые другие.
     * @param string $text - Текст сообщения, до 1000 символов. Символы подстановки типа игнорируются.
     * @return void
     */
    public function sendSms(string $phone, string $sender, string $text)
    {
        $method = 'sendSms';

        $data['phone'] = $phone;
        $data['sender'] = $sender;
        $data['text'] = $text;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Возвращает строку — статус отправки SMS-сообщения.
     * https://www.unisender.com/ru/support/api/messages/check-sms/sendEmail
     *
     * @param string $sms_id - Код сообщения, возвращённый методом sendSms.
     * @return void
     */
    public function checkSms(string $sms_id)
    {
        $method = 'checkSms';
        $data['sms_id'] = $sms_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для отправки одного индивидуального email-сообщения без использования персонализации
     * https://www.unisender.com/ru/support/api/messages/sendemail/
     *
     * @param string $email - Адрес получателя сообщения. Vasya Pupkin <vpupkin@gmail.com>
     * @param string $sender_name - Имя отправителя. Произвольная строка, не совпадающая с e-mail адресом (с аргументом sender_email).
     * @param string $sender_email - E-mail адрес отправителя.
     * @param string $subject - Строка с темой письма.
     * @param string $body - Текст письма в формате HTML.
     * @param string $list_id - Код списка, от которого будет предложено отписаться адресату в случае, если он перейдёт по ссылке отписки.
     * @param string $user_campaign_id - Ваш собственный код рассылки, к которой относится письмо
     * @param array $attachments - Вложенные в письмо файлы (их бинарное содержимое, base64 использовать нельзя!).
     * @param string $lang - Двухбуквенный код языка для автоматически добавляемой в каждое письмо строки со ссылкой отписки.
     * @param integer $track_read - Принимаемое значение – 0 или 1 – отслеживать ли факт прочтения e-mail сообщения.
     * @param integer $track_links - Принимаемое значение – 0 или 1 – отслеживать ли переходы по ссылкам в e-mail сообщениях
     * @param string $cc - Список email адресов через запятую. Содержит адреса вторичных получателей письма, которым направляется копия письма.
     * Не более 10
     * @param string $headers - Текст со списком заголовков, каждый заголовок — на отдельной строке в MIME-формате.
     * @param string $wrap_type - Помещение HTML-текста письма в дополнительную «обёртку» из HTML-кода с целью улучшения совместимости с различными почтовыми сервисами
     * @param string $images_as - Позволяет изменять режим обработки вложенных изображений в письме.
     * @param string $ref_key - Параметр может передаваться пользователем для присвоения письму ключа-идентификатора.
     * @param integer $error_checking - Принимаемое значение – 0 или 1.
     * @param array $metadata - Метаданные, отправляемые в запросе, возвращаются в Webhooks.
     * @return void
     */
    public function sendEmail(
        string $email,
        string $sender_name,
        string $sender_email,
        string $subject,
        string $body,
        string $list_id,
        string $user_campaign_id = '',
        array $attachments = [],
        string $lang = 'ru',
        int $track_read = 0,
        int $track_links = 0,
        string $cc = '',
        string $headers = '',
        string $wrap_type = 'skip',
        string $images_as = 'attachments',
        string $ref_key = '',
        int $error_checking = 0,
        array $metadata = []
    )
    {
        $method = 'sendEmail';

        $data['email'] = $email;
        $data['sender_name'] = $sender_name;
        $data['sender_email'] = $sender_email;
        $data['subject'] = $subject;
        $data['body'] = $body;
        $data['list_id'] = $list_id;

        if($user_campaign_id != ''){
            $data['user_campaign_id'] = $user_campaign_id;
        }

        foreach ($attachments as $key=>$val){
            $data['attachments['.$key.']'] = $val;
        }

        $data['lang'] = $lang;
        $data['track_read'] = $track_read;
        $data['track_links'] = $track_links;

        if($cc != ''){
            $data['cc'] = $cc;
        }

        if($headers != ''){
            $data['headers'] = $headers;
        }

        $data['wrap_type'] = $wrap_type;
        $data['images_as'] = $images_as;

        if($ref_key != ''){
            $data['ref_key'] = $ref_key;
        }

        $data['error_checking'] = $error_checking;

        foreach($metadata as $key=>$val){
            $data['metadata['.$key.']'] = $val;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для отправки тестового email-сообщения.
     * https://www.unisender.com/ru/support/api/messages/sendtestemail/
     *
     * @param string $email - Адрес получателя сообщения. Отправлять можно на несколько адресов, перечисленных через запятую
     * @param string $id - Идентификатор email-письма, созданного ранее.
     * @param string $format - Формат вывода.
     * @return void
     */
    public function sendTestEmail(string $email, string $id, string $format = 'json' )
    {
        $method = 'sendTestEmail';

        $data['email'] = $email;
        $data['id'] = $id;
        $data['format'] = $format;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод позволяет проверить статус доставки email-сообщений
     *
     * @param string $email_id - Код сообщения. Возможно указание до 500 кодов email через запятую.
     * @return void
     */
    public function checkEmail(string $email_id)
    {
        $method = 'checkEmail';

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * К каждому списку рассылки прикреплён текст приглашения подписаться и
     * подтвердить свой email, отправляемый контакту для подтверждения рассылки.
     * С помощью метода updateOptInEmail можно изменить текст письма.
     * https://www.unisender.com/ru/support/api/messages/updateoptinemail/
     *
     * @param string $sender_name - Имя отправителя. Произвольная строка, не совпадающая с e-mail адресом (аргумент sender_email).
     * @param string $sender_email - E-mail адрес отправителя
     * @param string $subject - Строка с темой письма. Может включать поля подстановки.
     * @param string $body - Текст письма в формате HTML с возможностью добавлять поля подстановки.
     * Текст обязательно должен включать в себя как минимум одну ссылку с атрибутом href=»{{ConfirmUrl}}».
     * @param string $list_id - Код списка, при подписке на который будет отправлять данное письмо.
     * @return void
     */
    public function updateOptInEmail(
        string $sender_name,
        string $sender_email,
        string $subject,
        string $body,
        string $list_id
    )
    {
        $method = 'updateOptInEmail';

        $data['sender_name'] = $sender_name;
        $data['sender_email'] = $sender_email;
        $data['subject'] = $subject;
        $data['body'] = $body;
        $data['list_id'] = $list_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для получения ссылки на веб-версию письма.
     * https://www.unisender.com/ru/support/api/messages/getwebversion/
     *
     * @param string $campaign_id - Идентификатор существующей кампании
     * @param string $format - Формат вывода принимает значения html | json, по умолчанию json
     * @return void
     */
    public function getWebVersion(string $campaign_id, string $format = 'json')
    {
        $method = 'getWebVersion';
        $data['campaign_id'] = $campaign_id;
        $data['format'] = $format;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для удаления сообщения.
     * https://www.unisender.com/ru/support/api/messages/deletemessage/
     *
     * @param string $message_id - Код сообщения
     * @return void
     */
    public function deleteMessage(string $message_id)
    {
        $method = 'deleteMessage';
        $data['message_id'] = $message_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для редактирования существующего email сообщения (без отправки).
     * https://www.unisender.com/ru/support/api/messages/updateemailmessage/
     *
     * @param string $id - Идентификатор сообщения для редактирования
     * @param string $sender_name
     * @param string $sender_email
     * @param string $subject
     * @param string $body
     * @param string $list_id
     * @param string $text_body
     * @param string $message_format
     * @param string $lang
     * @param string $raw_body
     * @param string $categories
     * @return void
     */
    public function updateEmailMessage(
        string $id,
        string $sender_name = '',
        string $sender_email = '',
        string $subject = '',
        string $body = '',
        string $list_id = '',
        string $text_body = '',
        string $message_format = '',
        string $lang = '',
        string $raw_body = '',
        string $categories = ''
    )
    {
        $method = 'updateEmailMessage';

        $data['id'] = $id;
        if($sender_name != ''){
            $data['sender_name'] = $sender_name;
        }
        if($sender_email != ''){
            $data['sender_email'] = $sender_email;
        }
        if($subject != ''){
            $data['subject'] = $subject;
        }
        if($body != ''){
            $data['body'] = $body;
        }
        if($list_id != ''){
            $data['list_id'] = $list_id;
        }
        if($text_body != ''){
            $data['text_body'] = $text_body;
        }
        if($message_format != ''){
            $data['message_format'] = $message_format;
        }
        if($lang != ''){
            $data['lang'] = $lang;
        }
        if($raw_body != ''){
            $data['raw_body'] = $raw_body;
        }
        if($categories != ''){
            $data['categories'] = $categories;
        }

        $res = $this->send($data, $method);
        return $res;
    }

}