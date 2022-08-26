@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('Update Temperature of Country') }}
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @include('shared.errors')

            <div class="card">
                <div class="header">
                    <h2><strong>{{ __('Update Temperature of Country') }}</strong></h2>
                </div>
                <div class="body">
                    <form id="form_validation" method="POST" action="{{ route('update.setting', $setting->id) }}">
                        @csrf
                        <div class="form-group form-float">
                            <label>{{ __('Country') }}</label>
                            <input type="text" class="form-control" name="country" value="{{ $setting->country }}">
                        </div>
                        <div class="form-group form-float">
                            <label>{{ __('Temperature') }}</label>
                            <input type="number" class="form-control" name="temperature"
                                value="{{ $setting->temperature }}">
                        </div>
                        <div class="form-group form-float">
                            <label>{{ __('Degree Type') }}</label>
                            <select class="form-control" name="degree_type">
                                <option value="F" {{ $setting->degree_type == 'F' ? 'selected' : '' }}>Fahrenheit</option>
                                <option value="C" {{ $setting->degree_type == 'C' ? 'selected' : '' }}>Celsius</option>
                            </select>
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect"
                            type="submit">{{ __('Update Temperature of Country') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
