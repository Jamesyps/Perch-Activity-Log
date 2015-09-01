<?php include('../../../core/inc/api.php');

// Perch API
$API = new PerchAPI(1.0, 'jw_activity_log');

// Language instance
$Lang = $API->get('Lang');

// Page Meta
$Perch->page_title = $Lang->get('Activity Log');

// Perch Frame
include(PERCH_CORE . '/inc/top.php');

// App Page

// Perch Frame
include(PERCH_CORE . '/inc/btm.php');
