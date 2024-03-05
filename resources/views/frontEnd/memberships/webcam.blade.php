@extends('layouts.app')
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style: none;
        outline: none
    }

    .video_chat-content #chat-form {
        /* position: absolute; */
        margin-top: 30px;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        /* align-items: center; */
        gap: 10px;
    }

    .video_chat-content #chat-form textarea {
        width: 76%;
    }

    .video_chat-content #chat-form button {
        border: 0;
        outline: unset;
        color: #fff;
        padding: 13px 20px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 10px;
    }

    #local-media {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    #local-media video {
        width: 100%;
    }

    .video_btn button {
        border: 0;
        outline: unset;
        background: #e91d25;
        color: #fff;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 10px;
    }

    #copy-link {
        background: #ddd !important;
    }

    .video_btn {
        display: flex;
        /* align-items: center; */
        gap: 10px;
    }


    #chat-btn {
        background: #1b4da6 !important;
        padding: 10px 40px !important;
    }

    .chat-text-box h4 {
        font-size: 16px;
        line-height: 24px;
        color: #000;
        /* padding-bottom: 8px; */
        margin: 0;
    }

    .chat-text-box p {
        font-size: 14px;
        line-height: 18px;
        color: #000;
        margin: 0;
    }

    .chat-box ul li {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        box-shadow: 1px 1px 10px #eee;
        padding: 10px;
        border-radius: 10px;
    }

    .image-box img {
        max-width: 25px;
    }

    @media (max-width: 767px) {
        .video_chat-content .row {
            flex-direction: column-reverse
        }

        .video_chat_main {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Create Video Room</div> --}}
                    <div class="card-body">
                        <div class="video_chat-content">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="chat-box" id="chat-div">
                                        {{-- <ul>
                                            <li>
                                                <div class="image-box">
                                                    <img src="" alt="">
                                                </div>
                                                <div class="chat-text-box">
                                                    <h4>Lorem, ipsum dolor.</h4>
                                                    <p>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam,
                                                        sit.
                                                    </p>
                                                </div>
                                            </li>
                                        </ul> --}}
                                    </div>
                                    {{-- <div id="chat-div">
                                        <ul>
                                            <li>
                                                sfdsad
                                            </li>
                                        </ul>
                                    </div> --}}
                                </div>
                                <div class="col-lg-4">
                                    <div class="video_chat_main">
                                        <div class="video_chat_box">
                                            <div class="video-box">
                                                {{-- <div id="remote-media"></div> --}}
                                                <div id="local-media"></div>
                                                <input type="hidden" id="room_link"
                                                    value="{{ url('chatroom') . '/' . $roomID }}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <form id="chat-form">
                                        <input type="hidden" name="room_id" value="{{ $roomID }}">
                                        {{-- <input type="text" name="msg" id="msg"> --}}
                                        <button type="button" id="copy-link">Copy Link</button>
                                        <textarea name="msg" id="msg"></textarea>
                                        <div class="video_btn">
                                            <button type="submit" id="chat-btn">Send</button>
                                            <a href="{{ url('home') }}"><button id="end-btn" type="button">End</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://sdk.twilio.com/js/video/releases/2.22.1/twilio-video.min.js"></script>
    <script src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#msg').emojioneArea();
        });
    </script>
    <script>
        const RoomId = `{{ $roomID }}`
        console.log(`{{ $accessToken }}`);
        const Video = Twilio.Video;
        Video.connect('{{ $accessToken }}', {
            name: '{{ $roomName }}',
            identity: '{{ $identity }}',
            maxParticipants: '{{ $participants }}',
            // audio: true,
            room_id: RoomId
        }).then(room => {
            console.log('Connected to Room "%s"', room.name, room);

            var localTracksPromise = Twilio.Video.createLocalTracks();
            localTracksPromise.then(function(localTracks) {
                localTracks.forEach(function(track) {
                    document.getElementById('local-media').appendChild(track.attach());
                });
            })

            room.participants.forEach(function(participant) {
                console.log('Participant name: ', participant.identity);
            });
            // room.localParticipant.on('trackAdded', function(track, participant) {
            // 	console.log(track,'track')
            // 	console.log(participant,'participant')
            // 	if (track.kind === 'video') {
            // 		// Check if the track is defined before accessing its properties
            // 		if (track !== null && typeof track !== 'undefined') {
            // 			console.log('Local video track added. Frame width: ', track.frameWidth);
            // 		} else {
            // 			console.log('Local video track is null or undefined.');
            // 		}
            // 	}
            // });

            room.on('trackSubscribed', function(track, publication, participant) {
                console.log('track', track)
                console.log('publication', publication)
                console.log('participant', participant)
                if (track.kind === 'video') {}
                let div = document.createElement("div")
                div.setAttribute('id', participant.sid)
                div.setAttribute('class', "video-stream")
                document.getElementById('local-media').appendChild(div);
                document.getElementById(participant.sid).appendChild(track.attach());
                $(".video-stream:empty").remove();
            });

            // room.participants.forEach(participantConnected);
            // room.on('participantConnected', participantConnected);

            room.on('participantDisconnected', participantDisconnected);
            room.once('disconnected', error => room.participants.forEach(participantDisconnected));
        })

        function participantConnected(participant) {
            console.log(participant);
            console.log('Participant "%s" connected', participant.identity);

            // const div = document.createElement('div');
            // div.id = participant.sid;
            // div.innerText = participant.identity;
            // console.log(participant);
            // // console.log('IS subscribe :',participant.isSubscribed)
            // // console.log('Track :',participant.track.kind)
            // // publication.isSubscribed && publication.track.kind === 'video'
            // // participant.on('trackSubscribed', track => trackSubscribed(div, track));
            // participant.tracks.forEach(track => trackSubscribed(div, track));
            // participant.on('trackUnsubscribed', trackUnsubscribed);

            // document.body.appendChild(div);
        }

        function participantDisconnected(participant) {
            console.log('Participant "%s" disconnected', participant.identity);

            // participant.tracks.forEach(trackUnsubscribed);
            document.getElementById(participant.sid).remove();
        }

        function trackSubscribed(div, track) {
            console.log(track);
            if (track.isSubscribed && track.kind === 'video') {
                div.appendChild(track.track.attach());
            }
        }

        function trackUnsubscribed(track) {
            track.detach().forEach(element => element.remove());
        }

        $('#chat-form').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: `{{ url('chat') }}`,
                data: {
                    _token: `{{ csrf_token() }}`,
                    room_id: '{{ $roomID }}',
                    msg: $("#msg").val()
                }, // serializes the form's elements.
                success: function(data) {
                    $('#chat-div').html(data.blade);
                    $("#msg").val("")
                }
            })
            // $('#chat-form').ajaxForm(function(res) {
            //     console.log(res);
            //     if (res.flag == 1) {
            //         $('#msg').val('');
            //         $('.emojionearea-editor').html('');
            //     }
            // }).submit();
        })

        $('#end-btn').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: `{{ url('chat-change-status') }}`,
                data: {
                    _token: `{{ csrf_token() }}`,
                    msg: $("#msg").val()
                }, // serializes the form's elements.
                success: function(data) {
                    window.location.href = "/profile";
                }
            })
        })

        function getAllChat() {

            $.ajax({
                type: "POST",
                url: `{{ url('chat/all') }}`,
                data: {
                    room_id: RoomId,
                    _token: `{{ csrf_token() }}`
                }, // serializes the form's elements.
                success: function(data) {
                    $('#chat-div').html(data.blade);
                }
            });
        }
        $(document).ready(function() {
            getAllChat();
        })

        // $(function() {
        // 	window.emojiPicker = new EmojiPicker({
        // 	  emojiable_selector: '[data-emojiable=true]',
        // 	  assetsPath: 'emojilib/img/',
        // 	  popupButtonClasses: 'fa fa-smile-o'
        // 	});
        // 	window.emojiPicker.discover();
        // });

        var pusher = new Pusher(`{{ config('constant.PUSHER_APP_KEY') }}`, {
            cluster: `{{ config('constant.PUSHER_APP_CLUSTER') }}`,
        });
        const channel = pusher.subscribe("chat");

        channel.bind("new_chat", (data) => {
            console.log('get Chat');
            getAllChat();
        });

        $('#copy-link').click(function() {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($('#room_link').val()).select();
            document.execCommand("copy");
            $temp.remove();
        })
    </script>
@endsection
