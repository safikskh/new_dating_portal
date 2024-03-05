@extends('dashlead.layouts.layout')
@section('pageTitle', 'Chatrum')
@push('style')
@endpush
@section('content')

<!-- Main Content-->
<div class="main-content pt-0">
    <div class="container">

        <!-- Page Header -->
        <div class="page-header">
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row">

            <!-- Main Section -->
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header">
                        <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Video Chat</h6>
                    </div>
                    <div class="wrapper j-wrapper">
        <main class="app" id="app">
        <div class="page">
            <!-- JOIN -->
            <form class="join j-join">
                

                <div class="join__body">
                    <div class="join__row">
                    <input type="hidden" class="join__input j-join__username" name="username" placeholder="Username" value="{{ $userData->quickblox_username }}">
                    </div>

                    <div class="join__row">
                    <input type="hidden" class="join__input j-join__login" name="login" placeholder="login" value="{{ $userData->quickblox_username }}">
                    </div>

                    <div class="join__row" style="display:none">
                        <button type="submit" class="join__btn">Login</button>
                    </div>
                </div>
            </form>

            <div class="dashboard j-dashboard">
            </div>
        </div>
    </main>

    <footer class="footer j-footer invisible">
        
    </footer>
</div>

<!-- MODALS -->

<div class="modal fade" id="join_err" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>

                <h4>Connect is failed</h4>
            </div>

            <div class="modal-body">

                <p class="text-danger error">

                </p>

                <p class="text-danger">
                    Something wrong with connect. Check internet connection or server credentials and trying again.
                </p>
            </div>
            <p></p>
        </div>
    </div>
</div>


<div class="modal fade" id="connect_err" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>

                <h4>Connect to chat is failed</h4>
            </div>

            <div class="modal-body">
                <p class="text-danger">
                    Something wrong with connect to chat. Check internet connection or user info and trying again.
                </p>
            </div>
            <p></p>
        </div>
    </div>
</div>

<div class="modal fade" id="already_auth" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Warning</h4>
            </div>

            <div class="modal-body">
                <p class="text-danger">User has already authorized.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="error_no_calles" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Error</h4>
            </div>

            <div class="modal-body">
                <p class="text-danger">Please choose users to call</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="income_call" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Opkald fra <strong class="j-ic_initiator"></strong></h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default j-decline">Afvis</button>
                <button type="button" class="btn btn-primary j-accept">accepter</button>
            </div>
        </div>
    </div>
</div>

<!-- SOUNDS -->
<audio id="endCallSignal" preload="auto">
    <source src="{{ asset('css/chatcss/audio/end_of_call.ogg') }}" type="audio/ogg"/>
    <source src="{{ asset('css/chatcss/audio/end_of_call.mp3') }}" type="audio/mp3"/>
</audio>

<audio id="callingSignal" loop preload="auto">
    <source src="{{ asset('css/chatcss/audio/calling.ogg') }}" type="audio/ogg"/>
    <source src="{{ asset('css/chatcss/audio/calling.mp3') }}" type="audio/mp3"/>
</audio>

<audio id="ringtoneSignal" loop preload="auto">
    <source src="{{ asset('css/chatcss/audio/ringtone.ogg') }}" type="audio/ogg"/>
    <source src="{{ asset('css/chatcss/audio/ringtone.mp3') }}" type="audio/mp3"/>
</audio>

<!-- TEMPLATES -->
<!-- stateBoard -->
<script type="text/template" id="tpl_default">
    Logged in as <b><%= name %></b>
    <button class='fw-link j-logout'>Logout</button>
</script>

<script type="text/template" id="tpl_during_call">
    Login in as <b><%= name %></b>
</script>

<script type="text/template" id="tpl_device_not_found">
    Error: devices (camera or microphone) are not found.
    <span class="qb-text">Login in <b>as <%=name%></b></span>
    <button class='fw-link j-logout'>Logout</button>
</script>

<script type="text/template" id="tpl_call_status">
    <% if(typeof(users.accepted) !== 'undefined') { %>
    <%  _.each(users.accepted, function(el, i, list) { %>
    <% if(list.length === 1){ %>
    <b><%= el.full_name %></b> has accepted the call.
    <% } else { %>
    <% if( (i+1) === list.length) { %>
    <b><%= el.full_name %></b> have accepted the call.
    <% } else { %>
    <b><%= el.full_name %></b>,
    <% } %>
    <% } %>
    <% }); %>
    <% } %>

    <% if(typeof(users.rejected) !== 'undefined') { %>
    <%  _.each(users.rejected, function(el, i, list) { %>
    <% if(list.length === 1){ %>
    <b><%= el.full_name %></b> has rejecterd the call.
    <% } else { %>
    <% if( (i+1) === list.length) { %>
    <b><%= el.full_name %></b> have rejecterd the call.
    <% } else { %>
    <b><%= el.full_name %></b>,
    <% } %>
    <% } %>
    <% }); %>
    <% } %>
</script>

<script type="text/template" id="tpl_call_stop">
    Call is stopped.&emsp;
    Login&nbsp;in&nbsp;as&nbsp;<%=name%>
    <button class='fw-link j-logout'>Logout</button>
</script>

<script type="text/template" id="p2p_call_stop">
    <b><%=name%> has <%=reason%>.</b> Call is stopped.&emsp;
    Login&nbsp;in&nbsp;as&nbsp;<%=currentName%>
    <button class='fw-link j-logout'>Logout</button>
</script>

<script type="text/template" id="dashboard_tpl">
    <div class="state_board j-state_board"></div>

    <div class="dashboard__inner inner">
        <div class="users j-users_wrap"></div>

        <div class="board clearfix j-board"></div>
    </div>
</script>

<script type="text/template" id="frames_tpl">
    <div class="frames">
        <div class="frames__main">
            <!-- <div class="frames__main_timer invisible" id="timer">
            </div> -->

            <div class="qb-video">
                <video id="main_video" class="frames__main_v qb-video_source" autoplay playsinline></video>
            </div>
        </div>

        <div class="frames__callees j-callees"></div>
    </div>

    <div class="caller">
        <div class="caller__ctrl">
            <button class="caller__ctrl_btn j-actions m-video_call" data-call="video"></button>
            <button class="caller__ctrl_btn j-actions m-audio_call" data-call="audio"></button>
        </div>

        <h4 class="caller__name">
            <b>You</b>
            <span class="j-caller_name">(<%= nameUser %>)</span>
        </h4>

        <div class="caller__frames">
            <div class="qb-video">
                <video id="localVideo" class="qb-video_source" autoplay playsinline></video>
            </div>

            <div class="caller__frames_acts">
                <button class="caller__frames_acts_btn j-caller__ctrl" data-target="video">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-290.000000, -80.000000)">
                                <g transform="translate(288.000000, 78.000000)">
                                    <path d="M0 0L24 0 24 24 0 24 0 0Z"/>
                                    <path class="svg_icon"
                                          d="M21 6.5L17 10.5 17 7C17 6.45 16.55 6 16 6L9.82 6 21 17.18 21 6.5 21 6.5ZM3.27 2L2 3.27 4.73 6 4 6C3.45 6 3 6.45 3 7L3 17C3 17.55 3.45 18 4 18L16 18C16.21 18 16.39 17.92 16.54 17.82L19.73 21 21 19.73 3.27 2 3.27 2Z"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>

                <% if(navigator.mediaDevices && navigator.mediaDevices.getDisplayMedia) { %>
                <button class="caller__frames_acts_btn j-caller__ctrl" data-target="screen">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-290.000000, -80.000000)">
                                <g transform="translate(288.000000, 78.000000)">
                                    <path d="M21.22 18.02l2 2H24v-2h-2.78zm.77-2l.01-10a2 2 0 0 0-2-2H7.22l5.23 5.23c.18-.04.36-.07.55-.1V7.02l4 3.73-1.58 1.47 5.54 5.54c.61-.33 1.03-.99 1.03-1.74zM2.39 1.73L1.11 3l1.54 1.54c-.4.36-.65.89-.65 1.48v10a2 2 0 0 0 2 2H0v2h18.13l2.71 2.71 1.27-1.27L2.39 1.73zM7 15.02c.31-1.48.92-2.95 2.07-4.06l1.59 1.59c-1.54.38-2.7 1.18-3.66 2.47z"
                                          fill="#626262"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
                <% } %>


                <button class="caller__frames_acts_btn j-caller__ctrl" data-target="audio">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-347.000000, -80.000000)">
                                <g transform="translate(344.000000, 78.000000)">
                                    <path d="M0 0L24 0 24 24 0 24 0 0Z"/>
                                    <path class="svg_icon"
                                          d="M19 11L17.3 11C17.3 11.74 17.14 12.43 16.87 13.05L18.1 14.28C18.66 13.3 19 12.19 19 11L19 11ZM14.98 11.17C14.98 11.11 15 11.06 15 11L15 5C15 3.34 13.66 2 12 2 10.34 2 9 3.34 9 5L9 5.18 14.98 11.17 14.98 11.17ZM4.27 3L3 4.27 9.01 10.28 9.01 11C9.01 12.66 10.34 14 12 14 12.22 14 12.44 13.97 12.65 13.92L14.31 15.58C13.6 15.91 12.81 16.1 12 16.1 9.24 16.1 6.7 14 6.7 11L5 11C5 14.41 7.72 17.23 11 17.72L11 21 13 21 13 17.72C13.91 17.59 14.77 17.27 15.54 16.82L19.73 21 21 19.73 4.27 3 4.27 3Z"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>

                <button class="caller__frames_acts_btn_record j-record" alt="record video">
                </button>

                
            </div>

            
        </div>
    </div>
</script>

<script type="text/template" id="users_tpl">

    <div style="padding-bottom: 10px;">
        <input type="text" id="search_by_username" class="join__input j-join__username" style="height: 50px;"
               name="username" placeholder="brugernavn" autofocus="" required="">
    </div>

    <div class="users__title" title="Choose a user to call">
    Vælg bruger du vil ringe til
        <button class="users__refresh j-users__refresh" title="click to refresh">
            <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Main" transform="translate(-435.000000, -178.000000)">
                        <g id="ic_refresh" transform="translate(431.000000, 174.000000)">
                            <g id="Icon-24px" sketch:type="MSShapeGroup">
                                <path d="M0,0 L24,0 L24,24 L0,24 L0,0 Z" id="Shape"></path>
                                <path d="M17.65,6.35 C16.2,4.9 14.21,4 12,4 C7.58,4 4.01,7.58 4.01,12 C4.01,16.42 7.58,20 12,20 C15.73,20 18.84,17.45 19.73,14 L17.65,14 C16.83,16.33 14.61,18 12,18 C8.69,18 6,15.31 6,12 C6,8.69 8.69,6 12,6 C13.66,6 15.14,6.69 16.22,7.78 L13,11 L20,11 L20,4 L17.65,6.35 L17.65,6.35 Z"
                                      id="Shape" fill="#808080"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </button>
    </div>

    <div class="users__list j-users">
    </div>
</script>

<script type="text/template" id="user_tpl">
    <div class="users__item">
        <button class="users__user j-user" data-id="<%= id %>" data-login="<%= login %>" data-name="<%= full_name %>">
            <i class="user__icon"></i>
            <span class="user__name"><%= login %></span>
            <i class="users__btn_remove j-user-remove"></i>
        </button>
    </div>
</script>

<script type="text/template" id="callee_video">
    <div class="frames_callee callees__callee j-callee">
        <div class="frames_callee__inner">
            <p class="frames_callee__status j-callee_status_<%=userID%>">
                <%=state%>
            </p>

            <div class="qb-video">
                <video class="j-callees__callee__video qb-video_source"
                       id="remote_video_<%=userID%>"
                       data-user="<%=userID%>" autoplay playsinline>
                </video>
            </div>
        </div>

        <p class="frames_callee__name"><%=name%></p>

        <div class="frames_callee__bitrate">
            <span id="bitrate_<%=userID%>">0</span> kbps
        </div>
    </div>
</script>
                </div>
            </div>
            <!-- Main Section -->
        </div>
        <!-- End Row -->

    </div>
</div>
<!-- End Main Content-->
<!-- <input type="hidden" id="userCallerId" data-id="{{ $userData->quickblox_id }}" data-login="{{ $userData->quickblox_username }}" data-name="{{ $userData->quickblox_username }}"> -->
@endsection
@push('style')
<link href="{{ asset('css/chatcss/styles.css') }}" rel="stylesheet">
@endpush
@push('script')

<script src="{{ asset('js/chatjs/underscore-min.js') }}"></script>
<script src="{{ asset('js/chatjs/backbone-min.js') }}"></script>
<script src="{{ asset('js/chatjs/qbMediaRecorder.js') }}"></script>
<script src="{{ asset('js/chatjs/quickblox.js') }}"></script>
<script src="{{ asset('js/chatjs/config.js') }}"></script>
<script src="{{ asset('js/chatjs/helpers.js') }}"></script>
<script src="{{ asset('js/chatjs/stateBoard.js') }}"></script>
<script src="{{ asset('js/chatjs/apps.js') }}"></script>
<script>
$(document).ready(function(){ $('.j-join').trigger('submit'); });    
</script>
@endpush