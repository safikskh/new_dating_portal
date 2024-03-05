<!-- Developed By CBS -->
  @extends('dashlead.layouts.chat')
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
            <!-- Main Section -->  
                <room-chat :user="{{ auth()->user() }}" :room="{{ $chatRoom }}" :chatroomlist="{{ $chatRoomList }}"></room-chat>
            <!-- Main Section -->
          </div>
        </div>
      <!-- End Main Content-->
  @endsection
  @push('script')
    <!-- Chat js-->
    <script src="{{ asset('dashlead/js/chat.js') }}"></script>
  @endpush
<!-- ./Developed By CBS -->