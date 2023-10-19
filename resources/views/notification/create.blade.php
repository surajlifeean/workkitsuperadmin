{!! Form::open(['route' => 'notifications.broadcast', 'method' =>  'post']) !!}
<div class="modal-body">
    <div class="row">
        
        <div class="form-group">
            {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
            <div class="form-icon-user">
                {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enter title']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('message', __('Message'), ['class' => 'form-label']) }}
            <div class="form-icon-user">
                {!! Form::text('message', null, ['class' => 'form-control', 'placeholder' => 'Enter Message']) !!}
            </div>
        </div>
        
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Submit')}}" class="btn btn-primary">
</div>

{!! Form::close() !!}
