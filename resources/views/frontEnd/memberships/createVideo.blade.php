@extends('dashlead.layouts.layout')
@section('pageTitle', 'Webcam Chat')
@section('content')
    <div class="main-content pt-0">
        <div class="container">
            {{-- <div class="row row-sm"> --}}
            <div class="row row-sm justify-content-center">
                <div class="page-header">
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div style="font-weight: bold; margin-bottom: 20px; text-transform:uppercase;">
                                <div style="display:flex;justify-content: space-between;align-items: center">
                                    <div>
                                        <h6 class="card-title mb-1">Webcam Chat</h6>
                                    </div>
                                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                                    <div class="dropdown">
                                        <form action="{{ route('gender-filter') }}" method="post" id="gender-filter-form">
                                            @csrf
                                            <select style="width: 100%" name="gender" class="form-control select2"
                                                id="changeGender">
                                                <option value="">Vælg din mulighed</option>
                                                @foreach (App\Enums\Sex::getValues() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ isset($gender) && $item == $gender ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="chat_type" value="0">
                                            <button class="btn btn-dark" type="submit">Change</button>
                                            <a class="btn btn-dark" type="button"
                                                href="{{ url('createVideoconference') }}">Clear</a>
                                        </form>
                                    </div>
                                    {{-- @if (auth()->user()->isPaid()) --}}
                                    <div>
                                        <form action="{{ route('createVideoRoom') }}" method="post" id="video-room-form">
                                            {{-- @csrf --}}
                                            <input id="participant" type="hidden" class="form-control" name="participant"
                                                value="50" required autofocus>
                                            <input id="room_name" type="hidden" class="form-control" name="room_name"
                                                value="{{ auth()->user()->email }}" required>
                                            <input type="hidden" name="gender" id="male" required
                                                value="{{ auth()->user()->portalInfo->sex }}">

                                            <button class="btn btn-dark" type="submit">Start stream</button>
                                        </form>
                                    </div>
                                    {{-- @endif --}}
                                </div>
                                <hr>
                            </div>
                            {{-- @if (auth()->user()->isPaid()) --}}
                            <div class="row">
                                @foreach ($roomlist as $room)
                                    {{-- @dd($room->portalJoinUsers[0]->username); --}}
                                    <div class="col-sm-3 col-md-3">
                                        <a target="_blank" href="{{ url('chatroom/' . $room->id) }}">
                                            <div class="card custom-card">
                                                <span class="badge badge-success">Live</span>

                                                @if (isset($room->portalJoinUsers[0]->profilePicture) && File::exists($room->portalJoinUsers[0]->profilePicture))
                                                    <img src="{{ asset($room->portalJoinUsers[0]->profilePicture) }}">
                                                @else
                                                    <img src="{{ asset('dashlead/img/default/404-dp.png') }}"
                                                        class="rounded-circle">
                                                @endif
                                                <span
                                                    class="badge badge-info">{{ isset($room->portalJoinUsers[0]->username) ? $room->portalJoinUsers[0]->username : '' }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            {{-- @else
                                <div style="text-align: center; margin-top: 100px; margin-bottom: 100px;">
                                    <h5 style="color:red;">Kun Et Betalt Medlem Kan Se Streams.</h5>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="setDataModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="myModalLabel">Webcam Chat</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="setDataForm">
                        <div class="form-row">
                            <label for="input1" class="col-lg-2 control-label"> Age</label>
                            <input type="number" name="age" min="18" max="80" class="form-control"
                                id="age">
                        </div>
                        <div class="form-row">
                            <label for="input1" class="col-lg-2 control-label"> Gender</label>
                            <select class="form-control select2" name="gender" id="gender">
                                {{-- <option>Gender</option> --}}
                                @foreach (App\Enums\Sex::getValues() as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    <script>
        $("#video-room-form").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: '{{ route('createVideoRoom') }}',
                method: "GET",
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    $("#setDataModel").modal('show');
                },
                error: function(err) {
                    swal('Error!', err.message, 'error').then(function() {
                        location.reload();
                    });
                }
            });
        });

        $("#setDataForm").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: '{{ route('stream-data') }}',
                method: "GET",
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    console.log(response);
                    window.location.href = response.route;
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script>
@endpush
