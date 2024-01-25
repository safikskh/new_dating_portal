@extends('layouts.welcome') 
@section('pageTitle', '') 
@section('content')
 <div id="fullpage">
  <nav class="navbar justify-content-between login-navbar">
    <a href="/welcome/faq">FAQ</a>
    <a href="/" class="navbar-brand"><img src="img/logoWithName.png"></a>
    <form class="form-inline" id="login-form" method="POST" action="{{ route('login') }}">
      @csrf
      <div>
        <a class="btn btn-primary fb-login-btn" href="{{ url('login/facebook') }}">Log ind via facebook</a>
        <span style="font-size: 14px; color: white;">or</span>
        <input placeholder="E-mail" id="email" name="email" type="email" class=" mr-sm-2 form-control login-email-field
          {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus
          style="border-radius: 25px;">
        <input placeholder="Adgangskode" id="password" name="password" type="password" class="mr-sm-2 form-control login-pass-field
          {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required style="border-radius: 25px;" autocomplete="new-password">
        <button type="submit" class="btn login-btn">Log på</button>
        <button type="submit" class="btn pw-resetbtn">
          <a href="{{ route('password.request') }}">Glemt dit login?</a>
        </button>
        @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
          @if ($errors->has('email'))
          <span class="invalid-feedback text-white" role="alert" style="margin-left: 317px;">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
      </div>
    </form>
  </nav>
  <section id="section1" class="section">
    <div class="row slider bs-slider" data-fade="slow" data-duration="5000" data-img="img/Sugardating.jpg;
                     img/Frækdating.jpg;
                     img/Dating.jpg">
      <div class="bs-nav clearfix">
        <a href="#" class="right" data-show="next"><i class="fa fa-chevron-right"></i></a>
        <a href="#" class="left" data-show="prev"><i class="fa fa-chevron-left"></i></a>
      </div>
    </div>
    <div class="right-side">
      <div class="signup-form">
        <a class="btn btn-primary fb-signup-btn" href="https://datingportalen.com/login/facebook">Opret med facebook</a>
        Eller e-mail
      <form action="{{route('signup.second')}}" method="POST">
        @csrf
          <div class="form-group">
            <input value="{{old('firstName')}}" type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstNameHelp"
              placeholder="Fornavn" required>
            <input value="{{old('lastName')}}" type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastNameHelp"
              placeholder="Efternavn">
          </div>
          <div class="form-group">
            <input value="{{old('email')}}" type="email" class="form-control" id="loginEmail" name="email" aria-describedby="emailHelp" placeholder="e-mail" required>
            @if ($errors->has('email'))
            <span class=" text-danger" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Ny adgangskode" required>
            @if ($errors->has('password'))
            <span class=" text-danger" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="birthdayInput" style="display: block;">Fødselsdag:</label>
            <select class="form-control" id="dateFormControlSelect" name="day">
              @for($i=1; $i <= 31; $i++) 
                <option value='{{$i}}'>{{$i}}</option>
              @endfor
            </select>
            <select class="form-control" id="monthFormControlSelect" name="month" required>
              <option selected value='1'>Januar</option>
              <option value='2'>Februar</option>
              <option value='3'>Marts</option>
              <option value='4'>April</option>
              <option value='5'>Maj</option>
              <option value='6'>Juni</option>
              <option value='7'>Juli</option>
              <option value='8'>August</option>
              <option value='9'>September</option>
              <option value='10'>Oktober</option>
              <option value='11'>November</option>
              <option value='12'>December</option>
            </select>
            <select class="form-control" id="yearFormControlSelect" name="year">
              @for($i=1920; $i <= date('Y') - 18; $i++)
            <option value='{{$i}}'>{{$i}}</option>
              @endfor
            </select>
          </div>
          <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="{{App\Enums\Sex::getValue('Mand')}}" required>
            <label class="form-check-label" for="inlineRadio1">Mand</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="{{App\Enums\Sex::getValue('Kvinde')}}">
            <label class="form-check-label" for="inlineRadio2">Kvinde</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="sex" id="inlineRadio3" value="{{App\Enums\Sex::getValue('Par')}}">
            <label class="form-check-label" for="inlineRadio3">Par</label>
          </div>
          <small style="display: block; margin-top: 0.5rem;">Når du trykker på opret profil accepterer du vores <a
              href="/terms_of_services">bruger- og handelsbetingelser</a>. Læs mere om hvordan vi behandler din data i vores <a
              href="/privacy_policy">privatlivspolitik</a>. Når du har oprettet dig, så vi du modtage e-mail notifikationer fra os -
            disse kan du til enhver tid framelde.</small>
          <button type="submit" class="btn signup-btn">Opret profil</button>
        </form>
      </div>
    </div>
  </section>
  <section id="section2" class="section">
    <section id="vid" class="presentation">
      <div class="vpop" data-toggle="modal" data-target="#introVideoModal"><img class="playme animated infinite pulse"
          src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1179484/play.png">
        <p class="text-center vid-txt">PESENTATION VIDEO</p>
      </div>
    </section>
  </section>
  <section id="section3" class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5 class="disclaimer-title">Nye funktioner</h5>
          <p class="disclaimer-para">Vi mener selv vi har tilføjet nogle nye, spændende og brugbare funktioner, som
            gerne skulle gøre det nemmere for
            dig at bruge vores side. <br> Prøv for eksempel at føre musen over et modtaget brev i din indbakke og se
            hvad der
            sker, smid et dugfrisk billede op fra stranden under vores funktion “fremhævninger”, eller gør brug af vores
            favorit
            indbakke. <br> I det hele taget har vi gjort det nemmere for dig at bruge vores side og gøre opmærksom på
            dig selv
            i din søgning.</p>

          <h5 class="disclaimer-title">100 % danskejet virksomhed</h5>
          <p class="disclaimer-para">Trods vores internationalt klingende .com adresse, er både idéen og folkene bag
            Datingportalen.com, helt dansk.</p>

          <h5 class="disclaimer-title">Hvorfor en portal?</h5>
          <p class="disclaimer-para">Da det ikke er unormalt at være på flere dating-platforme, har vi samlet de mest
            populære dating-former på een side,
            så du kun behøver at have een profil for at date på nettet hvad end du søger, og så endda billigere end
            andre datingsider.</p>
        </div>
        <div class="col-md-6">

          <h5 class="disclaimer-title">Nye medlemskabs-typer</h5>
          <p class="disclaimer-para">Da vi mener du skal have lov til at være nysgerrig uden at skulle betale for en
            måneds medlemskab eller mere, kan
            du kigge forbi en anden portal og se om det er noget for dig, for eksempel kun for en uge, en weekend eller
            blot
            en enkelt dag.</p>

          <h5 class="disclaimer-title">Merkøb er lig med rabat</h5>
          <p class="disclaimer-para">Ja du læste rigtigt, vi har gjort så det er billigere for dig for hver portal du
            tilmelder dig, så vi lever både
            op til vores slogan “One site - fits all” og til at vi er billigere end vores konkurrenter. Se vores <a
              data-toggle="modal" data-target="#showPricesModal" href="#">priser</a> her.</p>

          <h5 class="disclaimer-title">Dynamisk side</h5>
          <p class="disclaimer-para">Med det mener vi, at vi har nye funktioner undervejs allerede nu, og idéerne er
            mange til hvordan vi kan og vil forbedre
            siden i fremtiden, så vi håber du vil være med på vores rejse til at blive Danmarks bedste datingsite.</p>
        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="copyright">© 2019 All Rights Reserved</div>
          </div>
          <div class="col-md-6">
            <div class="terms">
              <ul>
                <li><a href="/privacy_policy">Privatlivspolitik</a></li>
                <li><a href="/terms_of_services">Bruger og handelsbetingelser</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </section>
</div>

<div class="modal" id="introVideoModal" tabindex="-1" role="dialog" aria-labelledby="introVideoModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="introVideoModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 0;">
        <video width="100%" height="100%" controls>
          <source src="https://datingportalen.com/videos/datingportalen_welcome_video_v3.mp4" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>
      </div>
    </div>
  </div>
</div>

 <!-- show prices Modal -->
<div class="modal fade bd-example-modal-lg" id="showPricesModal" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Abonnementstype</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <img src="{{asset('img/icon/cancel.svg')}}" alt="" srcset="">
        </button>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @include('layouts.pricessModalContent')
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

