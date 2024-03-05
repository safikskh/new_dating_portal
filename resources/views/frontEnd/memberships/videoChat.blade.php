<ul>
    @foreach ($data as $row)
        <li>
            <div class="image-box">
                <img src="{{ asset($row['user']['portalInfo']['profilePicture']) }}" alt="">
            </div>
            <div class="chat-text-box">
                <h4>{{ $row['user']['portalInfo']['firstName'] }} {{ $row['user']['portalInfo']['lastName'] }}</h4>
                <p>
                    {{ $row['msg'] }}
                </p>
            </div>
        </li>
    @endforeach
</ul>
