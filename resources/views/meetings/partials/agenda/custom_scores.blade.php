<div class="row">
    <div class="col-sm-12">
        <h3>Other Scores</h3>
        <table class="table table-bordered">
            <thead>
            <th>Member</th>
            <th>Reason</th>
            </thead>
            <tbody>
            @foreach($scores as $score)
                <tr>
                    <td>{{ $score->user }}</td>
                    <td>{{ $score->point_id == config('constants.categories.custom_point_category_id') ? $score->notes : $score->point->category }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>