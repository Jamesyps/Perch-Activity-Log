<?php

// Side Panel UI
echo $HTML->side_panel_start();

echo $HTML->para('In the sidebar you should try and give the user guidance and tips.');

echo $HTML->side_panel_end();

// Main Panel UI
echo $HTML->main_panel_start();
include('_subnav.php');

echo '<h1>' . $heading1 . '</h1>';
if (isset($message)) {
    echo $message;
}

?>

<?php if (PerchUtil::count($user)): ?>
    <?php echo $HTML->heading1('User'); ?>
    <table class="d">
        <thead>
            <tr>
                <?php foreach (array_keys($user) as $userPropertyKey): ?>
                    <th>
                        <?php echo $HTML->encode($userPropertyKey); ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($user as $userProperty): ?>
                    <th>
                        <?php echo $HTML->encode($userProperty); ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<?php echo $HTML->heading1(ucfirst($Action->resourceType())); ?>
    <table class="d">
        <thead>
            <tr>
                <th>
                    <?php echo $Lang->get('Title'); ?>
                </th>
                <th>
                    <?php echo $Lang->get('URL'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo $HTML->encode($Action->resourceTitle()); ?>
                </td>
                <td>
                    <pre><?php echo $HTML->encode($Action->resourceUrl()); ?></pre>
                </td>
            </tr>
        </tbody>
    </table>

<?php if ($Action->resourceModification()): ?>
    <?php echo $HTML->heading1('Preview'); ?>
    <pre class="log-preview"><?php echo $HTML->encode($Action->resourceModification()); ?></pre>
<?php endif; ?>


<?php
if ((PerchUtil::count($historical_logs) > 1) && ($Action->resourceType() === LOG_REGION_TYPE)) {

    echo $HTML->heading1('History');
    $i = 0;

    foreach ($historical_logs as $History) {
        if (isset($historical_logs[$i - 1])) {
            $a = explode("\n", $History->resourceModification());
            $b = explode("\n", $historical_logs[$i - 1]->resourceModification());

            $diff = new Diff($a, $b);
            $renderer = new Diff_Renderer_Html_SideBySide;
            $html = $diff->Render($renderer);

            if ($html) {
                echo '<div class="diff-table">';
                echo '<h2>' . $HTML->encode($Action->relativeTime() . ' by ' . $Action->userProperty('userUsername',
                            'N/A')) . '</h2>';
                echo $html;
                echo '</div>';
            }

        }

        $i++;
    }
}
?>

<?php echo $HTML->main_panel_end(); ?>