<?php

$HTML = $API->get('HTML');

$Paging = $API->get('Paging');
$Paging->set_per_page(15);

$Actions = new JwActivityLog_Actions($API);

$action_logs = array();
$action_logs = $Actions->all($Paging);

$filter_icons = array();
$filter_icons = $Actions->icons();

// Install App
if($action_logs == false) {
    $Actions->attempt_install();
    $message = $HTML->warning_message('There has not yet been any activity');
}
