<?php
/**
 * Created by PhpStorm.
 * User: Vitalii
 * Date: 2018-01-28
 * Time: 22:58
 */

?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Url</th>
        <th scope="col">Time(sec)</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($args as $key => $val) {
        echo'<tr>
            <th>'.$key.'</th><td>'.$val['url'].'</td><td>'.$val['seconds'].'</td><td>'.$val['date'].'</td></tr>';
    }
    ?>
    </tbody>
</table>
<form method="GET" action="download" class="navbar-form navbar-left">
    <button type="submit" class="btn btn-default">Download</button>
</form>
