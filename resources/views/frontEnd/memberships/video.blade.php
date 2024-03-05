<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
</head>

<body>
    <div id="remote-media"></div>
    <div id="local-media"></div>
    <input type="hidden" id="room_link" value="{{ url('room') . '/' . $roomID }}">
    <button type="button" id="copy-link">Copy Link</button>
    <a href="{{ url('home') }}"><button type="button">End</button></a>
    <div>
        <form action="{{ url('chat') }}" method="post" id="chat-form">
            @csrf
            <input type="hidden" name="room_id" value="{{ $roomID }}">
            {{-- <input type="text" name="msg" id="msg"> --}}
            <textarea name="msg" id="msg"></textarea>
            <button type="button" id="chat-btn">Send</button>
        </form>
    </div>

    <div id="chat-div"></div>

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
        }).then(room => {
            console.log('Connected to Room "%s"', room.name);

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
                document.getElementById('remote-media').appendChild(div);
                document.getElementById(participant.sid).appendChild(track.attach());
            });

            // room.participants.forEach(participantConnected);
            // room.on('participantConnected', participantConnected);

            room.on('participantDisconnected', participantDisconnected);
            room.once('disconnected', error => room.participants.forEach(participantDisconnected));
        })

        function participantConnected(participant) {
            console.log(participant);
            console.log('Participant "%s" connected', participant.identity);

            const div = document.createElement('div');
            div.id = participant.sid;
            div.innerText = participant.identity;
            console.log(participant);
            // console.log('IS subscribe :',participant.isSubscribed)
            // console.log('Track :',participant.track.kind)
            // publication.isSubscribed && publication.track.kind === 'video'
            // participant.on('trackSubscribed', track => trackSubscribed(div, track));
            participant.tracks.forEach(track => trackSubscribed(div, track));
            participant.on('trackUnsubscribed', trackUnsubscribed);

            document.body.appendChild(div);
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

        $(document).on('click', '#chat-btn', function() {
            $('#chat-form').ajaxForm(function(res) {
                console.log(res);
                if (res.flag == 1) {
                    $('#msg').val('');
                    $('.emojionearea-editor').html('');
                }
            }).submit();
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
</body>

</html>
