<?php

// Side Panel UI
echo $HTML->side_panel_start();

echo $HTML->para('In the sidebar you should try and give the user guidance and tips.');

echo $HTML->side_panel_end();

// Main Panel UI
echo $HTML->main_panel_start();
include('_subnav.php');

echo '<h1>' . $heading1 . '</h1>';
if (isset($message)) echo $message;

?>

<?php echo $HTML->heading1('User'); ?>
<?php echo $HTML->heading1(ucfirst($Action->resourceType())); ?>

<?php
if(PerchUtil::count($historical_logs) > 2) {

    echo $HTML->heading1('History');
    $i = 0;

    foreach($historical_logs as $History) {
        if(($i > 0) && ($i < count($historical_logs) - 1)) {
            $a = explode("\n", $History->resourceModification());
            $b = explode("\n", $historical_logs[$i - 1]->resourceModification());

            $diff = new Diff($a, $b);
            $renderer = new Diff_Renderer_Html_SideBySide;

            echo '<h2>' . $HTML->encode($Action->relativeTime() . ' by ' . $Action->userData('userUsername', 'N/A')) . '</h2>';
            echo $diff->Render($renderer);
        }

        $i++;
    }
}
?>

<?php echo $HTML->main_panel_end(); ?>