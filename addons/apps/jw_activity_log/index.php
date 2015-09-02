<?php include('../../../core/inc/api.php');

// Perch API
$API = new PerchAPI(1.0, 'jw_activity_log');

// Actions
include_once('JwActivityLog_Actions.class.php');
include_once('JwActivityLog_Action.class.php');


// Language instance
$Lang = $API->get('Lang');

// Page Meta
$Perch->page_title = $Lang->get('Activity Log');
$Perch->add_css($API->app_path() . '/assets/css/log.css');

// Page Initialising
include('modes/log.pre.php');

// Perch Frame
include(PERCH_CORE . '/inc/top.php');

// Page
include('modes/log.post.php');

// Perch Frame
include(PERCH_CORE . '/inc/btm.php');
