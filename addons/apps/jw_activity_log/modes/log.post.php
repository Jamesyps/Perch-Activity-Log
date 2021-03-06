<?php

// Side Panel UI
echo $HTML->side_panel_start();

echo $HTML->para('In the sidebar you should try and give the user guidance and tips.');

echo $HTML->side_panel_end();

// Main Panel UI
echo $HTML->main_panel_start();
include('_subnav.php');

echo $HTML->heading1('Recent Actions');
?>

<div class="jw-activity-log">
    <ul class="smartbar">
        <li class="<?php if ($filter == '*'): ?>selected<?php endif; ?>"><a
                href="<?php echo PerchUtil::html($API->app_path()); ?>"><?php echo $Lang->get('All'); ?></a></li>

        <?php if (PerchUtil::count($filter_icons)): ?>
            <?php foreach ($filter_icons as $event => $filename): ?>
                <li class="filter-icon <?php if (isset($type) && $type == $event): ?>selected<?php endif; ?>">
                    <a href="?type=<?php echo $HTML->encode($event); ?>">
                        <img src="<?php echo $filename; ?>" alt="<?php echo $HTML->encode($event); ?>" />
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (PerchUtil::count($filter_users)): ?>
            <li class="fin user-filter">
                <form action="./" method="GET">
                    <?php echo $Form->select_field('user', 'User', $filter_users_opts,
                        isset($userID) ? $userID : false); ?>
                    <button type="submit"><?php echo $Lang->get('Go'); ?></button>
                </form>
            </li>
        <?php endif; ?>
    </ul>

    <?php if (isset($message)) {
        echo $message;
    } ?>

    <?php if (PerchUtil::count($action_logs)): ?>
        <table class="d log-table">
            <thead>
                <tr>
                    <th class="icon">&nbsp;</th>
                    <th>
                        <?php echo $Lang->get('Action'); ?>
                    </th>
                    <th>
                        <?php echo $Lang->get('Type'); ?>
                    </th>
                    <th>
                        <?php echo $Lang->get('Title'); ?>
                    </th>
                    <th>
                        <?php echo $Lang->get('Account'); ?>
                    </th>
                    <th>
                        <?php echo $Lang->get('Role'); ?>
                    </th>
                    <th>
                        <?php echo $Lang->get('Date / Time'); ?>
                    </th>
                    <th class="action last">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($action_logs as $Action): ?>
                    <tr>
                        <td class="icon">
                            <img src="<?php echo $Action->icon(); ?>"
                                 alt="<?php echo $HTML->encode($Action->actionKey()); ?>" />
                        </td>
                        <td>
                            <?php echo $HTML->encode($Action->actionKeyFormat()); ?>
                        </td>
                        <td>
                            <?php echo $HTML->encode(ucfirst($Action->resourceType())); ?>
                        </td>
                        <td>
                            <?php echo $HTML->encode($Action->resourceTitle()); ?>
                        </td>
                        <td>
                            <?php echo $HTML->encode($Action->userProperty('userUsername', 'N/A')); ?>
                        </td>
                        <td>
                            <?php echo $HTML->encode($Action->userProperty('roleTitle', 'N/A')); ?>
                        </td>
                        <td>
                            <span title="<?php echo $HTML->encode($Action->actionDateTime()); ?>">
                                <?php echo $HTML->encode($Action->relativeTime()); ?>
                            </span>
                        </td>
                        <td>
                            <a class="action"
                               href="<?php echo $HTML->encode($API->app_path()); ?>/view/?id=<?php echo $HTML->encode(urlencode($Action->id())); ?>">
                                <?php echo $Lang->get('Details'); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        if ($Paging->enabled()) {
            echo $HTML->paging($Paging);
        }
        ?>
    <?php endif; ?>
</div>

<?php echo $HTML->main_panel_end(); ?>
