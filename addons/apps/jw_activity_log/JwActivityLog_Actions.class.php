<?php

class JwActivityLog_Actions extends PerchAPI_Factory
{
    protected $table = 'jw_activity_log_actions';
    protected $pk = 'actionID';

    protected $singular_classname = 'JwActivityLog_Action';

    public $static_fields = array();

    public function create($data)
    {
        // Meta data
        $data['actionDateTime'] = date("Y-m-d H:i:s");
        $data['resourceUrl'] = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

        // Remove sensitive information
        if(isset($data['userAccountData']['userPassword'])) unset($data['userAccountData']['userPassword']);
        if(isset($data['userAccountData']['userHash'])) unset($data['userAccountData']['userHash']);

        // Encode for storage
        $data['userAccountData'] = PerchUtil::json_safe_encode($data['userAccountData']);

        return parent::create($data);
    }
}
