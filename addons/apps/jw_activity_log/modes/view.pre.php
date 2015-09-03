<?php

if (!$CurrentUser->has_priv('jw_activity_log')) {
    PerchUtil::redirect(PERCH_LOGINPATH);
}

// Diff library
require_once('../lib/Diff.php');
require_once('../lib/Diff/Renderer/Html/SideBySide.php');
require_once('../lib/Diff/Renderer/Html/Inline.php');

$Actions = new JwActivityLog_Actions($API);

$result = false;
$message = false;

$HTML = $API->get('HTML');

// Setup data
$historical_logs = array();
$user = array();
$resource = array();

if (isset($_GET['id']) && $_GET['id'] != '') {
    $actionID = (int)$_GET['id'];
    $Action = $Actions->find($actionID);

    $historical_logs = $Actions->return_instances($Action->history());

    $user = $Action->userData(array(
        'userLastLogin',
        'userCreated',
        'userUpdated',
        'roleID',
        'roleSlug',
        'userEnabled',
        'userMasterAdmin',
        'roleMasterAdmin'
    ));

    $heading1 = 'View Log #' . $actionID;
}
