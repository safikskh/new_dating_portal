<div id="local-media"></div>
<div id="remote-media"></div>


<script src="https://sdk.twilio.com/js/video/releases/2.22.1/twilio-video.min.js"></script>
{{-- <script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script> --}}
{{-- <script type="text/javascript" src="https://sdk.twilio.com/js/client/v1.13/twilio.min.js"></script> --}}

{{-- <script>
// var videoClient = new Twilio.Video.Client('{{ $accessToken }}');

  // Connect to the room
  Twilio.Video.connect({ to: '{{ $accessToken }}' }).then(function(room) {
    console.log('Connected to Room:', room.name);

    // Attach the local video track
    Twilio.Video.createLocalVideoTrack().then(function(localTrack) {
      var localMediaContainer = document.getElementById('local-media-container');
      localMediaContainer.appendChild(localTrack.attach());
    });

    // Attach the remote video tracks
    room.participants.forEach(function(participant) {
      console.log('Participant connected:', participant.identity);

      participant.tracks.forEach(function(publication) {
        if (publication.isSubscribed) {
          var remoteMediaContainer = document.getElementById('remote-media-container');
          remoteMediaContainer.appendChild(publication.track.attach());
        }
      });

      participant.on('trackSubscribed', function(publication, track) {
        console.log('Track subscribed:', publication.trackName);
        var remoteMediaContainer = document.getElementById('remote-media-container');
        remoteMediaContainer.appendChild(track.attach());
      });
    });
  });

</script> --}}

<script>
	const Video = Twilio.Video;
	Video.connect('{{ $accessToken }}', { name: '{{$roomName}}',identity: '{{ $identity }}' }).then(room => {
		console.log('Connected to Room "%s"', room.name);


    var localTracksPromise = Twilio.Video.createLocalTracks();
		localTracksPromise.then(function(localTracks) {
			localTracks.forEach(function(track) {
				document.getElementById('local-media').appendChild(track.attach());
			});
		})

		room.participants.forEach(participantConnected);
		room.on('participantConnected', participantConnected);

		room.on('participantDisconnected', participantDisconnected);
		room.once('disconnected', error => room.participants.forEach(participantDisconnected));
	})

	function participantConnected(participant) {
		console.log('Participant "%s" connected', participant.identity);

		const div = document.createElement('div');
		div.id = participant.sid;
		div.innerText = participant.identity;

		participant.on('trackSubscribed', track => trackSubscribed(div, track));
		participant.tracks.forEach(track => trackSubscribed(div, track));
		participant.on('trackUnsubscribed', trackUnsubscribed);

		document.body.appendChild(div);
	}

	function participantDisconnected(participant) {
		console.log('Participant "%s" disconnected', participant.identity);

		participant.tracks.forEach(trackUnsubscribed);
			document.getElementById(participant.sid).remove();
	}

	function trackSubscribed(div, track) {
		console.log(track);
		if(track.isSubscribed && track.kind === 'video'){
			div.appendChild(track.track.attach());
		}
	}

	function trackUnsubscribed(track) {
		track.detach().forEach(element => element.remove());
	}
</script>