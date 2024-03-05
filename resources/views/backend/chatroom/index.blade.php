@extends('backend.layouts.app')


@section('content')
<!-- Breadcrumbs-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">chatroom</li>
    </ol>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
        <div class="pull-left">
            <i class="fas fa-table"></i>Dating Portalen
        </div>
        <div class="pull-right">
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#chatroomCreateModal" href="#"><i class="fa fa-plus" aria-hidden="true"></i>Chatroom</a>
        </div>   
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Chatroom Name</th>
                    <th>Portal Name</th>
                    {{-- <th>Membership Title</th> --}}
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Chatroom Name</th>
                    <th>Portal Name</th>
                    {{-- <th>Membership Title</th> --}}
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($chatrooms as $key => $chatroom)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $chatroom->chatroom_name }}</td>
                    <td>{{ App\Models\Portal::find($chatroom->portal_id)->portalType }}</td>
                    {{-- <td>{{ App\Models\Membership::find($chatroom->membership_id)->title}}</td> --}}
                    <td class="imaname"><img src="{{ asset('/'. $chatroom->chatroom_image) }}" alt="{{ $chatroom->chatroom_image }}" width="50" height="50" class="img img-circle"></td>
                    <td>
                        <a class="btn btn-sm btn-light editChatroom" data-toggle="modal" data-target="#chatroomEditModal" data-id="{{$chatroom->id}}" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        {!! Form::open(['method' => 'DELETE','route' => ['chatroom.destroy', $chatroom->id], 'class'=>'delete_form', 'style'=>'display:inline']) !!}
                            <a class="btn btn-sm btn-light delete-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

{{-- Start Modal 'for' post category create --}}
<div class="modal fade" id="chatroomCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chatroom Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            {!! Form::open(array('route' => 'chatroom.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('chatroom_name', null, array('placeholder' => 'Chatroom Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Portal:</strong>
                        <select name="portal_id" class="form-control">
                            <option selected disabled>Choose...</option>
                            @foreach(App\Models\Portal::all() as $item)
                                <option value="{{$item->id}}">{{$item->portalType}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Membership:</strong>
                        <select name="membership_id" class="form-control">
                            <option selected disabled>Choose...</option>
                            @foreach(App\Models\Membership::all() as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Chatroom Image:</strong>
                        {!! Form::file('chatroom_image', null, array('placeholder' => 'Image','class' => 'form-control')) !!}
                        @if ($errors->has('chatroom_image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('chatroom_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
{{-- End post category create Modal --}}

{{-- Start Modal 'for' Post category edit --}}
<div class="modal fade" id="chatroomEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chatroom</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body chatroomEditAdd">

        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
{{-- End Post category edit Modal --}}
@endsection
@section('style')
<style>
    a.btn.btn-sm.btn-light.showModal {
        background: #b9a4a436;
    }
</style>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        //edit chatroom in modal
        $(document).on('click', 'a.editChatroom', function() {
            var id = $(this).attr('data-id');
            $.get('chatroomEdit/'+id, function(data){
                $('#chatroomEditModal').find('.chatroomEditAdd').first().html(data);
            });
        });
       
    });
</script>
@endsection