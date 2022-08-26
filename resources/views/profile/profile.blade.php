@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('lang.profile') }}
@endsection

@section('content')
    <div class="row clearfix">

        <div class="col-xl-4 col-lg-12 col-md-12">
            <div class="card mcard_3">
                <div class="body">
                    <a href="profile.html"><img src="{{ asset('img/logoPT.png') }}" class="rounded-circle" alt="profile-image"></a>
                    <h4 class="m-t-10">{{ Auth::user()->name }}</h4>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <a href="#" class="btn btn-danger">{{ __('lang.edit') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <small class="text-muted">{{ __('lang.national-id') }}:</small>
                    <p>{{ Auth::user()->national_id }}</p>
                    <hr>

                    <small class="text-muted">{{ __('lang.email-address') }}:</small>
                    <p>{{ Auth::user()->email }}</p>
                    <hr>

                    <small class="text-muted">{{ __('lang.country') }}:</small>
                    <p>{{ Auth::user()->country }}</p>
                    <hr>

                    <small class="text-muted">{{ __('lang.nationality') }}:</small>
                    <p>{{ Auth::user()->nationality }}</p>
                    <hr>

                    <small class="text-muted">{{ __('lang.gender') }}:</small>
                    <p>{{ Auth::user()->gender }}</p>
                    <hr>

                    <small class="text-muted">{{ __('lang.phone') }}:</small>
                    <p>{{ Auth::user()->phone }}</p>
                    <hr>

                    <small class="text-muted">{{ __('lang.birth-Of-date') }}:</small>
                    <p>{{ Auth::user()->birth_date }}</p>
                    {{-- <hr> --}}

                    {{--  <small class="text-muted">{{ __('lang.role') }}:</small>  --}}
                    {{--  <p>{{ Auth::user()->role()->first()->role_name }}</p>  --}}
                    {{--
                    <hr>
                    <small class="text-muted">Client Types: </small>
                    <p>Text</p>
                    <hr> --}}

                </div>
            </div>
        </div>

    </div>
@endsection
