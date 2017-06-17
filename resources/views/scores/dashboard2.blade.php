<table class="table table-striped table-bordered table-condensed">
    <thead>
    <th>Toastmaster</th>
    <th>Points Breakdown</th>
    </thead>
    <tbody>
    <?php
    foreach ($currentScores as $user_id => $data) {
    if (count($data) > 0) {
    ?>
    <tr>
        <td><?= $users[$user_id] ?> </td>
        <td>
            <ul>
                <?php
                foreach ($data as $reason) {
                ?>
                <li><?= $reason; ?></li>
                <?php
                }
                ?>
            </ul>
        </td>
    </tr>
    <?php
    }
    }
    ?>
    </tbody>
</table>