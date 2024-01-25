{!! Form::model($chatroom, ['enctype' => 'multipart/form-data', 'method' => 'PATCH','route' => ['chatroom.update', $chatroom->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('chatroom_name', null, array('placeholder' => 'Chatroom Name','class' => 'form-control', 'required' => '')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Portal:</strong>
                        <select name="portal_id" class="form-control">
                            
                            @foreach(App\Models\Portal::all() as $item)
                                <option value="{{$item->id}}" {{$item->id == $chatroom->portal_id ? 'selected' : ''}}>{{$item->portalType}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Membership:</strong>
                        <select name="membership_id" class="form-control">
                            
                            @foreach(App\Models\Membership::all() as $item)
                                <option value="{{$item->id}}" {{$item->id == $chatroom->membership_id ? 'selected' : ''}}>{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            {!! Form::file('chatroom_image', null, array('placeholder' => 'Details','class' => 'form-control')) !!}
        </div>
        <img class="img img-thumbnail" style="margin-top: 3px;" src="{{ asset('/'. $chatroom->chatroom_image) }}" alt="{{ $chatroom->chatroom_image }}" width="70" height="50">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}