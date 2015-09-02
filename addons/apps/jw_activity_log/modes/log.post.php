<?php

// Side Panel UI
echo $HTML->side_panel_start();

echo $HTML->para('In the sidebar you should try and give the user guidance and tips.');

echo $HTML->side_panel_end();

// Main Panel UI
echo $HTML->main_panel_start();
include('_subnav.php');

echo $HTML->heading1('Recent Actions');
if (isset($message)) echo $message;

?>

<?php if(PerchUtil::count($action_logs)): ?>

<ul class="smartbar">
    <li class="selected"><a href="<?php echo PerchUtil::html($API->app_path()); ?>"><?php echo $Lang->get('All'); ?></a></li>
</ul>

<div class="jw-action-log">
    <table class="d log-table">
        <thead>
            <tr>
                <th class="first">
                    <?php echo $Lang->get('Action'); ?>
                </th>
                <th>
                    <?php echo $Lang->get('Account'); ?>
                </th>
                <th>
                    <?php echo $Lang->get('Role'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($action_logs as $Action): ?>
                <tr>
                    <td>
                        <?php echo $HTML->encode($Action->actionKey()); ?>
                    </td>
                    <td>
                        <?php echo $HTML->encode($Action->userData('userUsername', 'N/A')); ?>
                    </td>
                    <td>
                        <?php echo $HTML->encode($Action->userData('roleTitle', 'N/A')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>
<?php echo $HTML->main_panel_end(); ?>
