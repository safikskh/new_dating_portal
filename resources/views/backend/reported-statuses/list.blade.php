@extends('backend.layouts.app')


@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/admin')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Reported Statuses</li>
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
                <i class="fas fa-table"></i> Dating Portalen
            </div>
            {{--<div class="pull-right">
                <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#statusCreateModal" href="#"><i
                        class="fa fa-plus" aria-hidden="true"></i>Region</a>
            </div>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Report Description</th>
                        <th>Reported At</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Report Description</th>
                        <th>Reported At</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($all_statuses as $key => $status)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $status->user->portalInfo->firstName }} {{ $status->user->portalInfo->lastName }}</td>
                            <td>
                                {{ $status->status->title }}
                                <br>
                                {{ $status->status->details }}
                            </td>
                            <td>{{ $status->description }}</td>
                            <td>{{ $status->created_at }}</td>
                            {{--<td>
                                <a class="btn btn-sm btn-light editRegion" data-toggle="modal"
                                   data-target="#statusEditModal" data-id="{{$status->id}}" href="#"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                {!! Form::open(['method' => 'DELETE','route' => ['status.destroy', $status->id], 'class'=>'delete_form', 'style'=>'display:inline']) !!}
                                <a class="btn btn-sm btn-light delete-btn"><i class="fa fa-trash"
                                                                              aria-hidden="true"></i></a>
                                {!! Form::close() !!}
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
        $(document).ready(function () {
            //edit status in modal
            $(document).on('click', 'a.editRegion', function () {
                var id = $(this).attr('data-id');
                $.get('statusEdit/' + id, function (data) {
                    $('#statusEditModal').find('.statusEditAdd').first().html(data);
                });
            });

        });
    </script>
@endsection
