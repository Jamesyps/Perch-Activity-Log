<?php

class JwActivityLog_Actions extends PerchAPI_Factory
{
    protected $table = 'jw_activity_log_actions';
    protected $pk = 'actionID';

    protected $singular_classname = 'JwActivityLog_Action';

    public $static_fields = array();
}
