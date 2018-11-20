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
}