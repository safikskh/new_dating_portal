<!-- Developed By CBS -->
  @extends('dashlead.layouts.chat')
  @section('pageTitle', 'Fav Inbox')
  @push('style')
  <style>
    .file-upload input {
        display: none;
    }

    .cimage {
        width: 5rem;
        height: 2rem;
    }

    .right-sidebar-area {
        height: 100vh;
        overflow-y: auto;
    }

    progress {
        width: 100%;
        height: 10px;
    }
</style>
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
                @if (auth()->user()->isFavChatEmpty())
                <div class="card custom-card">
                    <div style="text-align: center; margin-top: 150px; margin-bottom: 150px;">
                        <h5 style="color:red;">Du har desværre ingen post, endnu.</h5>
                    </div>
                </div>
                @else
                    @if(Request::get('id') != null)
                        <user-chat :isfavorite={{1}} :newmessageuser={{ Request::get('id') }}></user-chat>
                        @else
                        <user-chat :isfavorite={{1}} :newmessageuser={{0}}></user-chat>
                    @endif
                @endif
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