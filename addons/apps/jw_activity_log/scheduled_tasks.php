<?php

PerchScheduledTasks::register_task('jw_activity_log', 'prune_actions_log', 1440, 'jw_activity_log_prune');

function jw_activity_log_prune($last_run_date)
{
    include_once('JwActivityLog_Actions.class.php');
    include_once('JwActivityLog_Action.class.php');

    $API = new PerchAPI(1.0, 'jw_activity_log');
    $Settings = $API->get('Settings');
    $Actions = new JwActivityLog_Actions($API);

    $total_pruned = $Actions->prune_logs((int) $Settings->get('jw_activity_log_prune_time')->settingValue());

    return array(
        'result' => 'OK',
        'message' => $total_pruned . ' logs pruned'
    );
}