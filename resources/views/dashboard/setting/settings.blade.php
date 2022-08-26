@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('Set Temperature of Country') }}
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @include('shared.errors')

            <div class="card">
                <div class="header">
                    <h2><strong>{{ __('Add New Temperature of Country') }}</strong></h2>
                </div>
                <div class="body">
                    <form id="form_validation" method="POST" action="{{ route('add.setting') }}">
                        @csrf
                        <div class="form-group form-float">
                            <label>{{ __('Country') }}</label>
                            <input type="text" class="form-control" name="country" value="{{ old('country') }}">
                        </div>
                        <div class="form-group form-float">
                            <label>{{ __('Temperature') }}</label>
                            <input type="number" class="form-control" name="temperature" value="{{ old('temperature') }}">
                        </div>
                        <div class="form-group form-float">
                            <label>{{ __('Degree Type') }}</label>
                            <select class="form-control" name="degree_type">
                                <option value="">choose</option>
                                <option value="F" {{ old('degree_type') == 'F' ? 'selected' : '' }}>Fahrenheit</option>
                                <option value="C" {{ old('degree_type') == 'C' ? 'selected' : '' }}>Celsius</option>
                            </select>
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect"
                            type="submit">{{ __('Add New Temperature of Country') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>List of Setting</strong></h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover c_table theme-color">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Country') }}</th>
                                <th>{{ __('Temperature') }}</th>
                                <th>{{ __('Degree Type') }}</th>
                                <th>{{ __('Edit') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings ?? '' as $setting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $setting->country }}</td>
                                    <td>{{ $setting->temperature }}</td>
                                    <td>{{ $setting->degree_type }}</td>
                                    <td>
                                        <a class="icon  btn btn-warning" href="{{ route('show.setting', $setting->id) }}">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <ul class="pagination pagination-primary mt-4">
                    <li class="page-item">{{ $settings->links() }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
