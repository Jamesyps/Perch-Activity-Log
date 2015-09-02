<?php

$HTML = $API->get('HTML');

$Paging = $API->get('Paging');
$Paging->set_per_page(15);

$Actions = new JwActivityLog_Actions($API);

$filter_icons = array();
$filter_icons = $Actions->icons();

$action_logs = array();
$filter = '*';

if(isset($_GET['type']) && $_GET['type']) {
    $filter = 'type';
    $type = $_GET['type'];
}

switch($filter)
{
    case 'type':
        $action_logs = $Actions->get_by('actionKey', $type, false, $Paging);
        break;
    default:
        $action_logs = $Actions->all($Paging);
        break;
}


// Install App
if($action_logs == false) {
    $Actions->attempt_install();
    $message = $HTML->warning_message('There has not yet been any activity');
}
