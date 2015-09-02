<?php

$pages = array();

$pages[] = array(
    'page'  => array('jw_activity_log', 'jw_activity_log/detail'),
    'label' => $Lang->get('Activity Log'),
    'priv'  => 'jw_activity_log'
);

echo $HTML->subnav($CurrentUser, $pages);
