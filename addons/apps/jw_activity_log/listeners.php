<?php

$API = new PerchAPI(1.0, 'jw_activity_log');

$API->on('*', function(PerchSystemEvent $Event) {
    PerchUtil::debug(json_encode($Event));
});
