<?php

/**
 * Class JwActivityLog_Actions
 *
 * @author James Wigger <james.s.wigger@gmail.com>
 */
class JwActivityLog_Actions extends PerchAPI_Factory
{
    /**
     * Log Table
     *
     * @var string
     */
    protected $table = 'jw_activity_log_actions';

    /**
     * Primary Key
     *
     * @var string
     */
    protected $pk = 'actionID';

    /**
     * Sort by column
     *
     * @var string
     */
    protected $default_sort_column = 'actionDateTime';

    /**
     * Sort direction
     *
     * @var string
     */
    protected $default_sort_direction = 'DESC';

    /**
     * Factory singular class
     *
     * @var string
     */
    protected $singular_classname = 'JwActivityLog_Action';

    /**
     * Non dynamic fields
     *
     * @var array
     */
    public $static_fields = array();

    /**
     * Insert a new log into the database, filtering sensitive information
     * and encoding data for storage.
     *
     * @param array $data
     * @return JwActivityLog_Action
     */
    public function create($data)
    {
        // Meta data
        $data['actionDateTime'] = date("Y-m-d H:i:s");
        $data['resourceUrl'] = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . $_SERVER['QUERY_STRING'];

        // Remove sensitive information
        if(isset($data['userAccountData']['userPassword'])) unset($data['userAccountData']['userPassword']);
        if(isset($data['userAccountData']['userHash'])) unset($data['userAccountData']['userHash']);

        // Encode for storage
        $data['userAccountData'] = PerchUtil::json_safe_encode($data['userAccountData']);

        return parent::create($data);
    }
}
