@extends('layouts.layout')
@section('pageTitle', ' | Profile')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="latest-news-bar-area">
                <div class="title-area">
                    <h3>Væggen</h3>
                </div>
                <div class="card-columns">
                    @foreach ($statusList as $item)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="card-title">
                                            {{$item->title}}
                                        </h4>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="dropdown float-right">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#reportModal">Report</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ url('profile?user_id='.$item->user_id) }}"
                                           class="{{$item->user->portalInfo->userNameColor}}">
                                            {{App\User::find($item->user_id)->portalInfo->userName}}
                                        </a>
                                        <p class="card-text">{{$item->details}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Report modal -->
                        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <img src="{{ asset('img/icon/cancel.svg') }}" alt="" srcset="">
                                        </button>
                                    </div>

                                    <form action="{{ route('status.report', $item->id) }}" method="post">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" name="description" id="description" class="form-control" placeholder="Description...">
                                            </div>

                                            <button type="submit" class="btn btn-radiaus">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
