<?php
if ($CurrentUser->logged_in() && $CurrentUser->has_priv('jw_activity_log')) {
    $this->register_app('jw_activity_log', 'Activity&nbsp;Log', 1, 'Track perch events to track user activity',
        '1.0.0');
    $this->require_version('jw_activity_log', '2.6');

    $this->add_setting('jw_activity_log_prune_time', 'Prune logs after', 'select', 90, array(
        array('label' => '1 Week', 'value' => 7),
        array('label' => '2 Weeks', 'value' => 14),
        array('label' => '1 Month', 'value' => 30),
        array('label' => '3 Months', 'value' => 90),
        array('label' => '6 Months', 'value' => 180),
        array('label' => '1 Year', 'value' => 365) // Leap years be damned!
    ));


    if (!defined('LOG_REGION_TYPE')) {
        define('LOG_REGION_TYPE', 'region');
    }

    if (!defined('LOG_ITEM_TYPE')) {
        define('LOG_ITEM_TYPE', 'item');
    }

    if (!defined('LOG_CATEGORY_TYPE')) {
        define('LOG_CATEGORY_TYPE', 'category');
    }

    if (!defined('LOG_ASSET_TYPE')) {
        define('LOG_ASSET_TYPE', 'asset');
    }

    include('listeners.php');
}