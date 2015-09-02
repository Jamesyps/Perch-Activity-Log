<?php

class JwActivityLog_Action extends PerchAPI_Base
{
    protected $table = 'jw_activity_log_actions';
    protected $pk = 'actionID';

    public function userData($key, $default = null)
    {
        $accountData = PerchUtil::json_safe_decode($this->userAccountData(), true);

        if(isset($accountData[$key]) && $accountData[$key])
        {
            return $accountData[$key];
        }

        return $default;
    }
}
