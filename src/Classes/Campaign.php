<?php
/**
 * https://www.unisender.com/ru/support/api/api/#stats
 */

namespace Zloykolobok\Unisender\Classes;

use Zloykolobok\Unisender\Unisender;

class Campaign extends Unisender
{
    /**
     * Получить отчёт по результатам доставки сообщений в заданной рассылке.
     *
     * @param integer $campaign_id - Идентификатор кампании
     * @param string $changed_since - Возвращать все статусы адресов, изменившиеся начиная с указанного
     * времени включительно (в формате «ГГГГ-ММ-ДД чч:мм:сс», часовой пояс UTC).
     * Если аргумент отсутствует, то возвращаются все статусы.
     * @param string $field_ids - Список id дополнительных полей, переданных через запятую.
     * @return void
     */
    public function getCampaignDeliveryStats(int $campaign_id, string $changed_since = '', string $field_ids = '' )
    {
        $method = 'getCampaignDeliveryStats';
        $data['campaign_id '] = $campaign_id;

        if($changed_since != ''){
            $data['changed_since'] = $changed_since;
        }

        if($field_ids != ''){
            $data['field_ids'] = $field_ids;
        }

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Получить общие сведения о результатах доставки сообщений в заданной рассылке.
     *
     * @param integer $campaign_id - Идентификатор кампании
     * @return void
     */
    public function getCampaignCommonStats(int $campaign_id)
    {
        $method = 'getCampaignCommonStats';
        $data['campaign_id '] = $campaign_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Получить отчёт по посещенным пользователями ссылкам в указанной email рассылке.
     *
     * @param integer $campaign_id - Идентификатор кампании
     * @param integer $group - Группировать результаты по посещенным ссылкам.
     * Если пользователь посетил ссылку несколько раз, в результатах это будет представлено одной записью,
     * с указанием количества посещений в поле count.
     * @return void
     */
    public function getVisitedLinks(int $campaign_id, int $group = 1)
    {
        $method = 'getVisitedLinks';
        $data['campaign_id'] = $campaign_id;
        $data['group'] = $group;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Метод для получения перечня всех имеющихся рассылок.
     *
     * @param string $from - Дата и время старта рассылки, начиная с которой нужно выводить рассылки,
     * в формате «ГГГГ-ММ-ДД чч:мм:сс», часовой пояс UTC.
     * @param string $to - Дата и время старта рассылки, заканчивая которой нужно выводить рассылки,
     * в формате «ГГГГ-ММ-ДД чч:мм:сс», часовой пояс UTC.
     * @param integer $limit - Количество записей в ответе на один запрос должно быть целым числом
     * в диапазоне 1 — 100 , по умолчанию стоит 50 записей.
     * @param integer $offset - Параметр указывает, с какой позиции начинать выборку.
     * Значение должно быть 0, или больше (позиция первой записи начинается с 0), по умолчанию 0.
     * @return void
     */
    public function getCampaigns(
        string $from = '',
        string $to = '',
        int $limit = 50,
        int $offset = 0
    )
    {
        $method = 'getCampaigns';

        if($from != '') {
            $data['from'] = $from;
        }

        if($to != '') {
            $data['to'] = $to;
        }

        $data['limit'] = $limit;
        $data['offset'] = $offset;


        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Узнать статус рассылки
     *
     * @param integer $campaign_id - Код рассылки
     * @return void
     */
    public function getCampaignStatus(int $campaign_id)
    {
        $method = 'getCampaignStatus';
        $data['campaign_id'] = $campaign_id;

        $res = $this->send($data, $method);
        return $res;
    }

    /**
     * Данный метод используется для получения списка писем
     *
     * @param string $format - формат вывода принимает значения html | json, по умолчанию json
     * @param string $date_from - дата создания больше чем, формат yyyy-mm-dd hh:mm UTC
     * @param string $date_to - дата создания меньше чем, формат yyyy-mm-dd hh:mm UTC
     * @param integer $limit - количество  записей в ответе на один запрос,
     * должен быть целое число в диапазоне 1 — 100 , по умолчанию 50
     * @param integer $offset - с какой позиции начинать выборку, должен быть 0 или больше
     * (позиция первой записи начинается с 0), по умолчанию 0
     * @return void
     */
    public function getMessages(
        string $format = 'json',
        string $date_from = '',
        string $date_to = '',
        int $limit = 50,
        int $offset = 0
    )
    {
        $method = 'getMessages';

        $data['format'] = $format;
        if($date_from != ''){
            $data['date_from'] = $date_from;
        }

        if($date_to != ''){
            $data['date_to'] = $date_to;
        }

        $data['limit'] = $limit;
        $data['offset'] = $offset;

        $res = $this->send($data, $method);
        return $res;
    }
}