<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://fiverr.com/wpdevmehedi
 * @since      1.0.0
 *
 * @package    Vote_Post
 * @subpackage Vote_Post/public/partials
 */
?>

<div data-id="<?php echo get_post()->ID ?>" class="voteModule">
    <?php 
    $votes = get_post_meta( get_post()->ID, "votepost_votes", true);
    $votes = ((is_array($votes)) ? $votes : []);

    $isMyVote = false;
    if(in_array(get_current_user_id(), $votes)){
        $isMyVote = true;
    }
    ?>
    <strong><?php echo sizeof($votes) ?></strong>

    <div class="voteBtns">
        <span class="vote <?php echo (($isMyVote) ? 'disabled': '') ?>">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5 -5 1460 1530" width="32" height="32" color="dodgerblue">
                <path id="ThumbsUp" fill="currentColor" stroke="none" stroke-width="0" transform="matrix(1,0,0,1,-9.17733,-10.9093)" d="M9.17733 859.815C9.17733 827.025 35.7587 800.444 68.548 800.444L254.272 800.444C287.061 800.444 313.643 827.025 313.643 859.815L313.643 1438.92C313.643 1471.71 287.061 1498.29 254.272 1498.29L68.548 1498.29C35.7587 1498.29 9.17733 1471.71 9.17733 1438.92ZM876.383 11.332C965.833 4.01467 1044.83 79.1853 1054.95 166.092C1073.2 259.504 1042.85 353.503 996.215 433.832C971.38 489.036 934.079 547.792 947.528 610.672C994.34 623.619 1052.67 609.076 1103.82 613.941C1187.46 615.889 1273.14 610.312 1354.95 630.228C1409.91 656.02 1445.93 715.133 1460.29 772.508C1456.79 825.152 1375.78 868.34 1430.27 921.868C1477.65 968.421 1451.91 1025.17 1407.78 1062.28C1367.11 1117.01 1458.17 1174.99 1416.25 1231.12C1385.82 1273.54 1325.56 1305.07 1341.08 1366.47C1348.18 1428.16 1287.72 1468.02 1243.89 1499.51C1166.71 1538.04 1076.33 1528.01 992.635 1530C852.525 1525.58 711.215 1523.81 574.115 1491.49C508.331 1479.03 442.235 1467.98 376.655 1454.59L374.72 832.113C430.072 839.979 474.68 800.36 503.96 757.7C568.764 670.388 603.92 566.6 650.351 469.6C693.733 404.252 778.291 373.483 803.62 294.48C839.663 210.812 843.5 118.38 853.155 29.1C849.093 17.564 884.652 11.052 876.376 11.3307Z"/>
            </svg>
        </span>
        <span class="downvote <?php echo (($isMyVote) ? '': 'disabled') ?>">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="-5 -5 1460 1530" width="32" height="32" color="red">
                <path id="ThumbsUp" fill="currentColor" stroke="none" stroke-width="0" transform="matrix(1,0,0,1,-9.17733,-10.9093)" d="M9.17733 859.815C9.17733 827.025 35.7587 800.444 68.548 800.444L254.272 800.444C287.061 800.444 313.643 827.025 313.643 859.815L313.643 1438.92C313.643 1471.71 287.061 1498.29 254.272 1498.29L68.548 1498.29C35.7587 1498.29 9.17733 1471.71 9.17733 1438.92ZM876.383 11.332C965.833 4.01467 1044.83 79.1853 1054.95 166.092C1073.2 259.504 1042.85 353.503 996.215 433.832C971.38 489.036 934.079 547.792 947.528 610.672C994.34 623.619 1052.67 609.076 1103.82 613.941C1187.46 615.889 1273.14 610.312 1354.95 630.228C1409.91 656.02 1445.93 715.133 1460.29 772.508C1456.79 825.152 1375.78 868.34 1430.27 921.868C1477.65 968.421 1451.91 1025.17 1407.78 1062.28C1367.11 1117.01 1458.17 1174.99 1416.25 1231.12C1385.82 1273.54 1325.56 1305.07 1341.08 1366.47C1348.18 1428.16 1287.72 1468.02 1243.89 1499.51C1166.71 1538.04 1076.33 1528.01 992.635 1530C852.525 1525.58 711.215 1523.81 574.115 1491.49C508.331 1479.03 442.235 1467.98 376.655 1454.59L374.72 832.113C430.072 839.979 474.68 800.36 503.96 757.7C568.764 670.388 603.92 566.6 650.351 469.6C693.733 404.252 778.291 373.483 803.62 294.48C839.663 210.812 843.5 118.38 853.155 29.1C849.093 17.564 884.652 11.052 876.376 11.3307Z"/>
            </svg>
        </span>
    </div>
</div>