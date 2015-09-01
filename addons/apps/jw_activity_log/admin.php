<?php

$this->register_app('jw_activity_log', 'Activity Log', 1, 'Track perch events to track user activity', '1.0.0');
$this->require_version('jw_activity_log', '2.6');

$this->add_setting('jw_activity_log_prune_time', 'Prune Logs After', 'select', 90, array(
    array('label' => '1 Week',   'value' => 7),
    array('label' => '2 Weeks',  'value' => 14),
    array('label' => '1 Month',  'value' => 30),
    array('label' => '3 Months', 'value' => 90),
    array('label' => '6 Months', 'value' => 180),
    array('label' => '1 Year',   'value' => 365) // Leap years be damned!
));
