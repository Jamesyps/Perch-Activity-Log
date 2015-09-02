<?php

include_once('JwActivityLog_Actions.class.php');
include_once('JwActivityLog_Action.class.php');


$API = new PerchAPI(1.0, 'jw_activity_log');
$Actions = new JwActivityLog_Actions($API);

/**
 * Regions
 */
$API->on('region.add_item', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_REGION_TYPE;
    $data['resourceID'] = $subject['regionID'];
    $data['resourceTitle'] = $subject['regionKey'];
    $data['resourceModification'] = $subject['regionHTML'];

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});

$API->on('region.publish', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_REGION_TYPE;
    $data['resourceID'] = $subject['regionID'];
    $data['resourceTitle'] = $subject['regionKey'];
    $data['resourceModification'] = $subject['regionHTML'];

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});

/**
 * Items
 */
$API->on('item.delete', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_ITEM_TYPE;
    $data['resourceID'] = $subject['itemID'];
    $data['resourceTitle'] = 'Item ID #' . $subject['itemID'];
    $data['resourceModification'] = null;

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});

/**
 * Categories
 */
$API->on('category.create', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_CATEGORY_TYPE;
    $data['resourceID'] = $subject['catID'];
    $data['resourceTitle'] = $subject['catTitle'];
    $data['resourceModification'] = null;

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});

$API->on('category.update', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_CATEGORY_TYPE;
    $data['resourceID'] = $subject['catID'];
    $data['resourceTitle'] = $subject['catTitle'];
    $data['resourceModification'] = null;

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});

/**
 * Assets
 */
$API->on('assets.create_image', function(PerchSystemEvent $Event) use($Actions) {
    $data = array();
    $user = $Event->user->to_array();
    $subject = $Event->subject->to_array();

    $data['actionKey'] = $Event->event;

    $data['userAccountID'] = $user['userID'];
    $data['userAccountData'] = $user;

    $data['resourceType'] = LOG_ASSET_TYPE;
    $data['resourceID'] = 0;
    $data['resourceTitle'] = $subject['file_name'];
    $data['resourceModification'] = null;

    // Save
    $Actions->create($data);

    // Debug
    PerchUtil::debug('Inserting new action log data:');
    PerchUtil::debug($data);
});

if(defined('PERCH_DEBUG') && PERCH_DEBUG) {
    $API->on('*', function (PerchSystemEvent $Event) use ($Actions) {
        PerchUtil::debug($Event->event);
    });
}
