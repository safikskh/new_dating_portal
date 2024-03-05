@extends('backend.layouts.app')


@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Announcements</li>
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
            <i class="fas fa-table"></i> Announcements
        </div>
        <div class="pull-right">
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#chatroomCreateModal" href="#"><i
                    class="fa fa-plus" aria-hidden="true"></i>Announcement</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Portal Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Portal Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($announcements as $key => $item)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{!! $item->detail !!}</td>
                        <td>{{ App\Models\Portal::find($item->portal_id)->portalType }}</td>
                        <td>
                            <a class="btn btn-sm btn-light editAnnouncement" data-toggle="modal"
                                data-target="#announcementEditModal" data-id="{{$item->id}}" href="#"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            {!! Form::open(['method' => 'DELETE','route' => ['announcement.destroy', $item->id],
                            'class'=>'delete_form', 'style'=>'display:inline']) !!}
                            <a class="btn btn-sm btn-light delete-btn"><i class="fa fa-trash"
                                    aria-hidden="true"></i></a>
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
    <div class="modal fade" id="chatroomCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Announcement Create</h5>
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
                    {!! Form::open(array('route' => 'announcement.store','method'=>'POST', 'enctype' =>
                    'multipart/form-data')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                {!! Form::text('title', null, array('placeholder' => 'Announcement title','class' =>
                                'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Details:</strong>
                                {!! Form::textarea('detail', null, array('placeholder' => 'Announcement details','class'
                                => 'form-control')) !!}
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
    <div class="modal fade" id="announcementEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body announcementEditAdd">

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

        .tox .tox-toolbar__group {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            margin: 0 0;
            padding: 0 4px;
            display: none;
        }
    </style>
    @endsection
    @section('script')
    <!-- <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=c7ucyxtmch8aaxtb05u723gi9foyar6cr8nlr4e2p3g1gp63"></script>
    <script>tinymce.init({selector:'textarea'});</script>

    <script>
        $(document).ready(function(){
        //edit chatroom in modal
        $(document).on('click', 'a.editAnnouncement', function() {
            var id = $(this).attr('data-id');
            $.get('announcementEdit/'+id, function(data){
                $('#announcementEditModal').find('.announcementEditAdd').first().html(data);
            });
        });
       
    });
    tinymce.init({
        selector: 'textarea',
        plugins: [
            "code table"
        ],
        menubar: false,
        branding: false,
        toolbar_drawer: 'floating',
    });
    </script> -->
    @endsection