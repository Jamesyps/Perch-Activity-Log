<?php

// Diff library
require_once('../lib/Diff.php');
require_once('../lib/Diff/Renderer/Html/SideBySide.php');
require_once('../lib/Diff/Renderer/Html/Inline.php');

$Actions = new JwActivityLog_Actions($API);

$result = false;
$message = false;

$HTML = $API->get('HTML');

if (isset($_GET['id']) && $_GET['id']!='') {
    $actionID = (int) $_GET['id'];
    $Action = $Actions->find($actionID);
    $details = $Action->to_array();

    $historical_logs = $Actions->return_instances($Action->history());

    $heading1 = 'View Log #' . $actionID;
}
