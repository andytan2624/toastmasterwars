<div class="row">
    <div class="col-sm-12">
        <table class="table table-sm table-bordered">
            <tbody>
            <tr>
                <th scope="row">Meeting</th>
                <td> {{ $meeting->id }}</td>
            </tr>
            <tr>
                <th scope="row">Date</th>
                <td> {{ $meeting->getNiceMeetingDate() }}</td>
            </tr>
            <tr>
                <th scope="row">Venue</th>
                <td colspan="2">{{ $meeting->club }}</td>
            </tr>
            <tr>
                <th scope="row">Category</th>
                <td colspan="2">{{ $category->name }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>