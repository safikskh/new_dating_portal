@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Før vi kan oprette din profil, skal vi bede dig om at bekræfte din mailadresse.') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Et nyt link til bekræftelse af din mail adresse er sendt.') }}
                        </div>
                    @endif
                    {{ __('Du skulle meget gerne have modtaget en mail herom, og husk at tjekke din spam mappe hvis ikke du har modtaget en mail fra
                    os.') }} <br>
                    {{ __('Hvis du ikke har modtaget en dette') }}, <a href="{{ route('verification.resend') }}">{{ __('tryk venligst her for at modtage en ny bekræftelsesmail') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
