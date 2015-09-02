<?php

/**
 * Class JwActivityLog_Action
 *
 * @author James Wigger <james.s.wigger@gmail.com>
 */
class JwActivityLog_Action extends PerchAPI_Base
{
    /**
     * Log Table
     *
     * @var string
     */
    protected $table = 'jw_activity_log_actions';

    /**
     * Primary Key
     *
     * @var string
     */
    protected $pk = 'actionID';

    /**
     * Directory for icon files
     *
     * @var string
     */
    const ICON_DIR = 'assets/icons';

    /**
     * Icon file type
     *
     * @var string
     */
    const ICON_EXT = '.png';

    /**
     * Map event keys to file names
     *
     * @var array
     */
    private $iconMap = array(
        'region.create'       => 'region_create',
        'region.add_item'     => 'region_add_item',
        'region.publish'      => 'region_publish',
        'item.delete'         => 'item_delete',
        'category.create'     => 'category_create',
        'category.update'     => 'category_update',
        'assets.create_image' => 'assets_create_image'
    );

    /**
     * Return icon for event type or default if none exists
     *
     * @return string
     */
    public function icon()
    {
        if(!isset($this->iconMap[$this->actionKey()])) {
            return PerchUtil::file_path($this->api->app_path() . '/' . self::ICON_DIR . '/' . 'generic' . self::ICON_EXT);
        }

        return PerchUtil::file_path($this->api->app_path() . '/' . self::ICON_DIR . '/' . $this->iconMap[$this->actionKey()] . self::ICON_EXT);
    }

    /**
     * Format action key name for users
     *
     * @return string
     */
    public function actionKeyFormat()
    {
        return ucwords(str_replace(array('.', '_'), ' ', $this->actionKey()));
    }

    /**
     * Return associated user data as array
     *
     * @param array $except
     * @return array
     */
    public function userData(array $except = array())
    {
        $accountData = PerchUtil::json_safe_decode($this->userAccountData(), true);

        foreach($except as $removeKey) {
            unset($accountData[$removeKey]);
        }

        return $accountData;
    }

    /**
     * Return property from the userAccountData json store
     * with an optional default for missing values
     *
     * @param $key
     * @param null $default
     * @return null
     */
    public function userProperty($key, $default = null)
    {
        $accountData = PerchUtil::json_safe_decode($this->userAccountData(), true);

        if (isset($accountData[$key]) && $accountData[$key]) {
            return $accountData[$key];
        }

        return $default;
    }

    /**
     * Fetch related logs that have occurred before
     * the current one
     *
     * @return array
     */
    public function history()
    {
        $sql = "
        SELECT * FROM " . $this->table .
        " WHERE `resourceType` = " . $this->db->pdb($this->resourceType()) .
        " AND `resourceID` = " . $this->db->pdb($this->resourceID()) .
        " AND `actionDateTime` <= " . $this->db->pdb($this->actionDateTime()) .
        " ORDER BY `actionDateTime` DESC";

        $result = $this->db->get_rows($sql);

        return $result;
    }

    /**
     * Return a relative time string (... Ago)
     *
     * @author Matthew Temple
     * @link https://gist.github.com/mattytemple/3804571
     * @return string
     */
    public function relativeTime()
    {
        $ts = $this->actionDateTime();

        if (!ctype_digit($ts)) {
            $ts = strtotime($ts);
        }
        $diff = time() - $ts;
        if ($diff == 0) {
            return 'now';
        } elseif ($diff > 0) {
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 60) {
                    return 'just now';
                }
                if ($diff < 120) {
                    return '1 minute ago';
                }
                if ($diff < 3600) {
                    return floor($diff / 60) . ' minutes ago';
                }
                if ($diff < 7200) {
                    return '1 hour ago';
                }
                if ($diff < 86400) {
                    return floor($diff / 3600) . ' hours ago';
                }
            }
            if ($day_diff == 1) {
                return 'Yesterday';
            }
            if ($day_diff < 7) {
                return $day_diff . ' days ago';
            }
            if ($day_diff < 31) {
                return ceil($day_diff / 7) . ' weeks ago';
            }
            if ($day_diff < 60) {
                return 'last month';
            }

            return date('F Y', $ts);
        } else {
            $diff = abs($diff);
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 120) {
                    return 'in a minute';
                }
                if ($diff < 3600) {
                    return 'in ' . floor($diff / 60) . ' minutes';
                }
                if ($diff < 7200) {
                    return 'in an hour';
                }
                if ($diff < 86400) {
                    return 'in ' . floor($diff / 3600) . ' hours';
                }
            }
            if ($day_diff == 1) {
                return 'Tomorrow';
            }
            if ($day_diff < 4) {
                return date('l', $ts);
            }
            if ($day_diff < 7 + (7 - date('w'))) {
                return 'next week';
            }
            if (ceil($day_diff / 7) < 4) {
                return 'in ' . ceil($day_diff / 7) . ' weeks';
            }
            if (date('n', $ts) == date('n') + 1) {
                return 'next month';
            }

            return date('F Y', $ts);
        }
    }
}
