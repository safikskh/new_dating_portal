@extends('backend.layouts.app')


@section('content')

<!-- Breadcrumbs-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
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
            <i class="fas fa-table"></i>Users Management
        </div>
        <!-- @can('user-create') -->
        <div class="pull-right">
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#userCreateModal" href="#"><i class="fa fa-plus" aria-hidden="true"></i>User</a>
        </div>
        <!-- @endcan -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a class="btn btn-sm btn-light showUser" data-toggle="modal" data-target="#userShowModal" data-id="{{$user->id}}" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a class="btn btn-sm btn-light editUser" data-toggle="modal" data-target="#userEditModal" data-id="{{$user->id}}" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id], 'class'=>'delete_form', 'style'=>'display:inline']) !!}
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
    </div>
{!! $data->render() !!}

{{-- Start Modal 'for' user create --}}
<div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Create</h5>
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
            {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
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
{{-- End user create Modal --}}

{{-- Start Modal 'for' user show --}}
<div class="modal fade" id="userShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Show</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body userShowAdd">

        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
{{-- End user show Modal --}}

{{-- Start Modal 'for' user edit --}}
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body userEditAdd">

        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
{{-- End user edit Modal --}}
@endsection
@section('sytle')
@endsection
@section('script')
<script>
    $(document).ready(function(){
        //show user in modal
        $(document).on('click', 'a.showUser', function() {
            var id = $(this).attr('data-id');
            $.get('userShowModal/'+id, function(data){
                $('#userShowModal').find('.userShowAdd').first().html(data);
            });
        });
        //edit user in modal
        $(document).on('click', 'a.editUser', function() {
            var id = $(this).attr('data-id');
            $.get('userEditModal/'+id, function(data){
                $('#userEditModal').find('.userEditAdd').first().html(data);
            });
        });
       
    });
</script>
@endsection