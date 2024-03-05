@extends('layouts.layout')
@section('pageTitle', ' | Forside')
@section('content')
    <div>
        <div class="row">

            <div class="col-lg-8">
                <div class="row">
                    {{-- first section on user dashboard --}}
                    @include('layouts.sectionOne')
                    {{-- second section on user dashboard --}}
                    @include('layouts.sectionTwo')
                </div>
            </div>
            {{-- promotion section --}}
            @include('layouts.promotationsection')
        </div>
    </div>
@endsection
