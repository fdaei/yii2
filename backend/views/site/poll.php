<?php
/** @var integer $yes */
/** @var integer $no */
?>
<div>
    <h6>Result:</h6>
    <table>
        <tr>
            <td>Yes:</td>
            <td><img src="poll.gif"
                     width='<?php echo(100*round($yes/($no+$yes),2)); ?>'
                     height='20'>
                <?php echo(100*round($yes/($no+$yes),2)); ?>%
            </td>
        </tr>
        <tr>
            <td>No:</td>
            <td><img src="poll.gif"
                     width='<?php echo(100*round($no/($no+$yes),2)); ?>'
                     height='20'>
                <?php echo(100*round($no/($no+$yes),2)); ?>%
            </td>
        </tr>
    </table>
</div>
