<?php

if (!defined('PERCH_DB_PREFIX')) {
    exit;
}

// Create tables
$sql = "
CREATE TABLE IF NOT EXISTS `__PREFIX__jw_activity_log_actions` (
  `actionID` int(11) NOT NULL AUTO_INCREMENT,
  `actionKey` varchar(64) NOT NULL,
  `actionDateTime` datetime DEFAULT NULL,
  `userAccountID` int(11) NOT NULL,
  `userAccountData` text,
  `resourceType` varchar(64) NOT NULL,
  `resourceID` int(11) NOT NULL,
  `resourceTitle` varchar(255) NOT NULL,
  `resourceModification` text,
  `resourceUrl` varchar(255) NOT NULL,
  PRIMARY KEY(`actionID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

INSERT INTO `__PREFIX__settings` (`settingID`, `userID`, `settingValue`)
VALUES ('jw_activity_log_prune_time', 0, 30);";

$sql = str_replace('__PREFIX__', PERCH_DB_PREFIX, $sql);

// Install
$statements = explode(';', $sql);
foreach ($statements as $statement) {
    $statement = trim($statement);
    if ($statement != '') {
        $this->db->execute($statement);
    }
}

$API = new PerchAPI(1.0, 'jw_activity_log');
$UserPrivileges = $API->get('UserPrivileges');
$UserPrivileges->create_privilege('jw_activity_log', 'Access the activity log');

$sql = 'SHOW TABLES LIKE "' . $this->table . '"';
$result = $this->db->get_value($sql);

return $result;
