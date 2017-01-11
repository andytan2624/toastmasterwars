<div class="row">
    <div class="col-sm-12">
        <h3>Speeches</h3>
        <table class="table table-bordered">
            <thead>
                <th>Speaker</th>
                <th>Topic</th>
                <th>Time</th>
                <th>Evaluator</th>
            </thead>
            <tbody>
                @foreach($speechScores as $score)
                    <tr>
                        <td>{{ $score->user }}</td>
                        <td>{{ $score->speech_title }}</td>
                        <td>{{ $score->speaking_time }}</td>
                        <td>{{ $score->speechEvaluator }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>