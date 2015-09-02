<?php

if ($CurrentUser->has_priv('jw_activity_log')) {
    PerchUtil::redirect(PERCH_LOGINPATH);
}

$HTML = $API->get('HTML');
$Form = $API->get('Form');

$Paging = $API->get('Paging');
$Paging->set_per_page(20);

$Actions = new JwActivityLog_Actions($API);

$filter_icons = array();
$filter_icons = $Actions->icons();

$filter_users = array();
$filter_users_opts = array();
$filter_users = $Actions->get_stored_users_unique();

if(PerchUtil::count($filter_users))
{
    foreach($filter_users as $filter_user)
    {
        $filter_users_opts[] = array(
            'label' => $filter_user['userUsername'],
            'value' => $filter_user['userID']
        );
    }
}

$action_logs = array();
$filter = '*';

if(isset($_GET['type']) && $_GET['type']) {
    $filter = 'type';
    $type = $_GET['type'];
}

if(isset($_GET['user']) && $_GET['user']) {
    $filter = 'user';
    $userID = $_GET['user'];
}

switch($filter)
{
    case 'type':
        $action_logs = $Actions->get_by('actionKey', $type, false, $Paging);
        break;
    case 'user':
        $action_logs = $Actions->get_by('userAccountID', $userID, false, $Paging);
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
