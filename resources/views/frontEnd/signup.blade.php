@extends('layouts.welcome')
@section('pageTitle', ' | Signup')
@section('content')
<div class="container">
    <div class="customAlert">
        <div class="customAlert-style">
            <div class="d-flex justify-content-center alert-text-style">
                <h5>This email has been registered.</h5>
            </div>
        </div>
    </div>
    <span class="logo-button logo-position">
        <a href="/">
            <img src="img/logo.png" class="logo">
        </a>
    </span>
    <form id="regForm" method="POST" action="{{ action('frontEnd\SignupController@store') }}">
        @csrf
        <div class="tab">
            <h2 class="title-of-page" style="text-align:center;">Opret din profil</h2>
            <div class="center">
                @php
                $currentURL = \Request::fullUrl();
                Session::put('prev_url', $currentURL);
                @endphp
                <a class="butfacebook" href="{{ url('login/facebook') }}" >Opret med facebook</a>
                <p class="btn-sub-title">Vi deler ikke noget på vegne af dig.</p>
                <div class="divder"></div>
                <p class="f1p">Eller du kan indtaste din e-mail nedenfor</p>
            </div>

            <input type="hidden" name="iAmSeekingA" value="{{$iAmSeekingA}}">
            <div class="secondf">
            <p  >
                <input type="email" class="emailGet" placeholder="mail@mailesen.mail" name="email"
                    value="{{old('email')}}">
                <br>
                @if ($message = Session::get('emailError'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
                @endif
            </p>
            <p>
                <input type="password" class="emailGet" placeholder="adgangskode" name="password" value="{{old('password')}}">
                @if ($errors->has('password'))
                <br>
                <span class=" text-danger" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span> @endif
            </p>
            </div>
            <div class="butn" style="text-align: right; margin-right: 60px;">
               <div >
                <button style="margin-top:12px;" class="signup-next-btn getEmail" type="button" id="nextBtn" onclick="nextPrev(1)">Næste</button>
            </div>
            </div>
        </div>
        <div class="tab">
            <h2 style="text-align:center;">Fortæl os lidt om dig selv</h2>
            <div class="secondf">
                <p class="firstnameLastname">For-og efternavn (vi deler ikke dette med andre brugere)</p>
                <p>
                    <input placeholder="Fornavn" name="firstName" id="Fornavn" value="{{old('firstName')}}">
                    @if ($errors->has('firstName'))
                    <br>
                    <span class=" text-danger" role="alert">
                        <strong>{{ $errors->first('firstName') }}</strong>
                    </span>
                    @endif
                </p>

                <p>
                    <input placeholder="Efternavn" name="lastName" value="{{old('lastName')}}">
                    @if ($errors->has('lastName'))
                    <br>
                    <span class=" text-danger" role="alert">
                        <strong>{{ $errors->first('lastName') }}</strong>
                    </span>
                    @endif
                </p>

                <div class="fsc">
                    <p class="pms">Fødselsdag</p>
                    <p>
                        <input type="date" placeholder="dd/mm/yyyy" name="dob" value="{{old('dob')}}">
                        <small id="doberror" style="margin-left: 2%;" class=" text-muted">Min 18 years</small>

                    </p>
                </div>
                <div class="fsc">
                    <p class="pms">Seksuel orientering</p>
                    <p>
                        <select class="select-second optioncolor" name="sexualOrientation" required>
                            @if(old('sexualOrientation') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($sexualOrientation as $item)

                            <option value="{{$item}}" {{$item == old('sexualOrientation') ? 'selected' : ''}}>{{$item}}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('sexualOrientation'))
                        <br>
                        <span class=" text-danger" role="alert">
                            <strong>{{ $errors->first('sexualOrientation') }}</strong>
                        </span> @endif
                    </p>
                    <div class="butn">
                        <div style="margin-top:12px;  text-align: right">
                            <button class="signup-next-btn" type="button" id="nextBtn"
                                onclick="nextPrev(1)">Næste</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab">
            <h2 style="text-align:center;">Fortæl os lidt mere</h2>
            <div class="mainthird">
                <div class="colum">
                    <p>
                        <label>Postnummer</label>
                        <input placeholder="Postnummer" name="zipCode" class="input-height" value="{{old('zipCode')}}">
                    </p>
                    <p>
                        <label>Køn</label>
                        <select name="sex" class="select-second optioncolor" required>
                            @if(old('sex') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($sex as $item)
                            <option value="{{$item}}" {{$item == old('sex') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Civilstatus</label>
                        <select name="civilStatus" class="select-second optioncolor" required>
                            @if(old('civilStatus') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($civilStatus as $item)
                            <option value="{{$item}}" {{$item == old('civilStatus') ? 'selected' : ''}}>{{$item}}
                            </option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Brugernavn</label>
                        <input placeholder="Brugernavn" name="username" class="input-height"
                            value="{{old('username')}}">                          
     
                        <br>
                        <span class=" text-danger" role="alert">
                            <strong id="usernameerror"></strong>
                        </span> 
                    </p>
                    <p>
                        <label>Højde</label>
                        <select name="height" class="select-second optioncolor" required>
                            @if(old('height') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($height as $item)
                            <option value="{{$item}}" {{$item == old('height') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>

                    </p>
                    <p>
                        <label>Vægt</label>
                        <select name="weight" class="select-second optioncolor" required>
                            @if(old('weight') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($weight as $item)
                            <option value="{{$item}}" {{$item == old('weight') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Hårfarve</label>
                        <select name="hairColor" class="select-second optioncolor" required>
                            @if(old('hairColor') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($hairColor as $item)
                            <option value="{{$item}}" {{$item == old('hairColor') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Øjenfarve</label>
                        <select name="eyeColor" class="select-second optioncolor" required>
                            @if(old('eyeColor') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($eyeColor as $item)
                            <option value="{{$item}}" {{$item == old('eyeColor') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                </div>
                <div class="colum">
                    <p>
                        <label>Lokation</label>
                        <select name="region_id" class="select-second optioncolor" required>
                            @if(old('region_id') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach (App\Models\Region::all() as $item)
                            <option value="{{$item->id}}" {{$item == old('region_id') ? 'selected' : ''}}>{{$item->region_name}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p style="margin-top: 18px;">
                        <label>Søger</label>
                        <select name="searching[]" class="select-second optioncolor selectpicker form-control" multiple
                            title="Vælg din mulighed" required>
                            @foreach ($searching as $item)
                            <option value="{{$item}}" @if(old('searching') !=null) @foreach(old('searching') as $p)
                                @if($item==$p) selected="selected" @endif @endforeach @endif>
                                {{$item}}
                            </option>
                            @endforeach
                        </select>

                    </p>
                    <p style="margin-top: 20px;">
                        <label>Kropsbygning</label>
                        <select name="bodyType" class="select-second optioncolor" required>
                            @if(old('bodyType') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($bodyType as $item)
                            <option value="{{$item}}" {{$item == old('bodyType') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Tatoveringer</label>
                        <select name="tattoos" class="select-second optioncolor" required>
                            @if(old('tattoos') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($tattoos as $item)
                            <option value="{{$item}}" {{$item == old('tattoos') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Piercing</label>
                        <select name="piercing" class="select-second optioncolor" required>
                            @if(old('piercing') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($piercing as $item)
                            <option value="{{$item}}" {{$item == old('piercing') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Børn</label>
                        <select name="children" class="select-second optioncolor" required>
                            @if(old('children') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($children as $item)
                            <option value="{{$item}}" {{$item == old('children') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>
                    <p>
                        <label>Ryger</label>
                        <select name="smoking" id="" class="select-second optioncolor" required>
                            @if(old('smoking') == null)
                            <option value="" disabled selected>Vælg din mulighed</option>
                            @endif
                            @foreach ($smoking as $item)
                            <option value="{{$item}}" {{$item == old('smoking') ? 'selected' : ''}}>{{$item}}</option>
                            @endforeach
                        </select>
                    </p>

                    <p style="margin-top: 69px;">
                        <label>Matchord</label>
                        <input class="abc" data-role="tagsinput" placeholder="Matchord" name="matchWords"
                            value="{{old('matchWords')}}">
                    </p>
                    <div class="butn" style>
                        <div style="margin-top:12px;  text-align: right">
                            <button class="signup-next-btn" type="button" id="nextBtn"
                                onclick="nextPrev(1)">Næste</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab">
            <h2 style="text-align:center;">Medlemskab</h2>
            <p style="text-align:center;">
                Vi er glade for at du har valgt at oprette en profil hos os, og vi håber at du finder hvad du end søger.
                Herunder kan du
                vælge om du vil være betalende medlem eller ej” & “Men vi synes du skal prøve vores portaler som medlem.
                Helt ned til 20
                kr. for en dags medlemskab.
            </p>
            <div class="mainbox">
                <div class="collum">
                    <h4 style="text-align:center;">Medlemskab</h4>
                    <p>
                        Som ikke-betalende medlem går du glip af: <br>
                        - Ikke at kunne se billeder udover profilbilleder <br>
                        - Kun modtage post, men ikke indlede en samtale <br>
                        - Ikke at kunne oprette blogs, events eller grupper <br>
                        - Ikke bruge “blokér” funktionen <br>
                        - Og meget andet, se vores FAQ for den fulde liste
                    </p>
                    <a>
                        <button type="submit" name="status" value="free">Jeg kigger bare</button>
                    </a>
                </div>
                <div class="collum">
                    <h4 style="text-align:center;">Medlemskab</h4>
                    <p>
                        Få fuld adgang til alle funktioner som betalende medlem. Der er flere muligheder for medlemskab,
                        feks. 1 dag, 1 uge, 1 måned,
                        3 måneder osv. <br> Har du en rabatkode så tryk på knappen “Gør mig til medlem”, og indtast din
                        kode på næste side.
                    </p>
                    <a>
                        <button class="paid-button" type="submit" name="status" value="paid">Gør mig til medlem</button>
                    </a>
                </div>
                <div class="tearms-of-services-link">
                    <a target="_blank" style="text-align:center; " class="underline-txt" href="/terms_of_services">
                        Tryk her for at se handelsbetingelser
                    </a>
                </div>
            </div>
        </div>
        <div class="step-bubble">
            <span class="step">1</span>
            <span class="step">2</span>
            <span class="step">3</span>
            <span class="step">4</span>
            <span class="step">5</span>
        </div>
    </form>
</div>
<style>
    .d-flex.justify-content-center.alert-text-style {
        position: absolute;
        left: 15%;
        top: 30%;
    }

    .customAlert:before {
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        background-color: #333;
        opacity: 0.5;
        z-index: 10;
    }

    .customAlert-style {
        position: fixed;
        width: 352px;
        height: 130px;
        background: #ec0000;
        color: #ffffff;
        margin: auto;
        left: 36%;
        top: 30%;
        z-index: 1000000;
    }

    .customAlert {
        position: fixed;
        width: 100%;
        height: 100%;
        display: none;
        left: 0%;
        top: 0%;
        z-index: 100000;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
          $('.getEmail').click(function() {
            var email = $('.emailGet').val()
            $.get('emailCheck/'+email, function(data){
               if(data === 'This Email already registered'){
                $('.customAlert').css('display','block');
                setTimeout(function(){ 
                  $('.customAlert').css('display','none');
                 }, 3000);
               }
            });
          });
        });

</script>

@endsection