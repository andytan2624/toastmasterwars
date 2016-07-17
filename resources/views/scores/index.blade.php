@extends('app')

@section('content')
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <th>Rank</th>
            <th>Toastmaster</th>
            <th>Score</th>
        </thead>
        <tbody>
            <?php
            $rank = 1;
            foreach ($tallyArray as $user_id => $score) {
                ?>
                <tr>
                    <td><?= $rank ?> </td>
                    <td><?= $users[$user_id] ?> </td>
                    <td><?= $score ?> </td>
                </tr>
                <?php
                $rank++;
            }
            ?>
        </tbody>
    </table>


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
                            <ul>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>@stop