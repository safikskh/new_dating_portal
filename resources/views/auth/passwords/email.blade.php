@extends('layouts.app')
@section('pageTitle', 'Nulstil kodeord')
@section('content')
<!-- Main Content-->
    <div class="main-content pt-0">   
        <div class="container">
            <!-- Page Header -->
                <div class="page-header"></div>
            <!-- End Page Header -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card custom-card">
                        <div class="card-header" style="margin-bottom: 10px;">
                            <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">{{ __('Nulstil kodeord') }}</h5>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email adresse') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send link til nulstilning af kodeord') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Main Content-->
@endsection
