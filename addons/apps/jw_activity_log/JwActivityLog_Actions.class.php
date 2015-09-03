<?php include_once('JwActivityLog_EventIconsTrait.php');

/**
 * Class JwActivityLog_Actions
 *
 * @author James Wigger <james.s.wigger@gmail.com>
 */
class JwActivityLog_Actions extends PerchAPI_Factory
{
    use EventIcons;

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
        $data['resourceUrl'] = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];

        // Remove sensitive information
        if (isset($data['userAccountData']['userPassword'])) {
            unset($data['userAccountData']['userPassword']);
        }
        if (isset($data['userAccountData']['userHash'])) {
            unset($data['userAccountData']['userHash']);
        }

        // Encode for storage
        $data['userAccountData'] = PerchUtil::json_safe_encode($data['userAccountData']);

        return parent::create($data);
    }

    /**
     * Fetch the unique stored users from the database and
     * decode the stored user data.
     *
     * @return array
     */
    public function get_stored_users_unique()
    {
        $return = array();

        $sql = "SELECT `userAccountData` FROM " . $this->table . " GROUP BY `userAccountID` ORDER BY `actionDateTime` DESC";
        $results = $this->db->get_rows($sql);

        if (PerchUtil::count($results)) {
            foreach ($results as $row) {
                $return[] = PerchUtil::json_safe_decode($row['userAccountData'], true);
            }
        }

        return $return;
    }

    /**
     * Delete records older than $days from the database
     *
     * @param int $days
     * @return int
     */
    public function prune_logs($days)
    {
        $total_sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE `ActionDateTime` < DATE_SUB('" . date('Y-m-d') . "', INTERVAL " . $days . " DAY)";
        $total = $this->db->get_count($total_sql);

        echo $total_sql;

        $prune_sql = "DELETE FROM " . $this->table . " WHERE `ActionDateTime` < DATE_SUB('" . date('Y-m-d') . "', INTERVAL " . $days . " DAY)";
        $this->db->execute($prune_sql);

        return $total;
    }
}
