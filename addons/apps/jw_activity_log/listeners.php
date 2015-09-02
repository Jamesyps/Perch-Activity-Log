<?php

include('JwActivityLog_Actions.class.php');
include('JwActivityLog_Action.class.php');

$API = new PerchAPI(1.0, 'jw_activity_log');
$Actions = new JwActivityLog_Actions($API);

$API->on('region.publish', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_REGION_TYPE;
    $data['resourceID'] = $subject['regionID'];
    $data['resourceModification'] = $subject['regionHTML'];

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});
