<div id="{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        {!! Form::open($form_parameters) !!}
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                <p>
                    {{ $message or '' }}
                </p>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! Form::close() !!}}
    </div>
</div>