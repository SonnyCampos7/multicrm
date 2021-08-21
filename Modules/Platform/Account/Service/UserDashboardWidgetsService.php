<?php
/**
 * Created by PhpStorm.
 * User: laravel-bap.com
 * Date: 05.01.19
 * Time: 11:30
 */

namespace Modules\Platform\Account\Service;


use Modules\Platform\Account\Dto\EmailSettingsDTO;
use Modules\Platform\Core\Helper\UserSettings;

class UserDashboardWidgetsService
{

    public const ENABLED_DASH_COUNT = 'enabled_dash_count';

    public const ENABLED_DASH_LEADS_OVERVIEW = 'enabled_dash_leads_overview';

    public const ENABLED_DASH_INCOME_VS_EXPENSES = 'enabled_dash_income_vs_expenses';

    public const ENABLED_DASH_NEW_TICKETS = 'enabled_dash_new_tickets';

    public const ENABLED_DASH_TICKETS_OVERVIEW = 'enabled_dash_tickets_overview';

    /**
     * @param null $userId
     * @return array
     */
    public function getSettings($userId = null)
    {
        return [
            self::ENABLED_DASH_COUNT => UserSettings::get(self::ENABLED_DASH_COUNT, true, $userId),
            self::ENABLED_DASH_LEADS_OVERVIEW => UserSettings::get(self::ENABLED_DASH_LEADS_OVERVIEW, true, $userId),
            self::ENABLED_DASH_INCOME_VS_EXPENSES => UserSettings::get(self::ENABLED_DASH_INCOME_VS_EXPENSES, true, $userId),
            self::ENABLED_DASH_NEW_TICKETS => UserSettings::get(self::ENABLED_DASH_NEW_TICKETS, true, $userId),
            self::ENABLED_DASH_TICKETS_OVERVIEW => UserSettings::get(self::ENABLED_DASH_TICKETS_OVERVIEW, true, $userId),
        ];
    }

    /**
     * @param $values
     * @param null $userId
     */
    public function saveSettings($values, $userId = null)
    {
        UserSettings::set( self::ENABLED_DASH_COUNT, $values[self::ENABLED_DASH_COUNT],$userId);
        UserSettings::set( self::ENABLED_DASH_LEADS_OVERVIEW, $values[self::ENABLED_DASH_LEADS_OVERVIEW],$userId);
        UserSettings::set( self::ENABLED_DASH_INCOME_VS_EXPENSES, $values[self::ENABLED_DASH_INCOME_VS_EXPENSES],$userId);
        UserSettings::set( self::ENABLED_DASH_NEW_TICKETS, $values[self::ENABLED_DASH_NEW_TICKETS],$userId);
        UserSettings::set( self::ENABLED_DASH_TICKETS_OVERVIEW, $values[self::ENABLED_DASH_TICKETS_OVERVIEW],$userId);
    }

}
