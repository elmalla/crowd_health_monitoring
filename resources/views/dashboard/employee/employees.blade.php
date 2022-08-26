@extends('layouts.dasboard')

@section('pagename-navbar')
   {{ __('lang.employees') }}
@endsection

@section('content')
    @if (Auth::user()->isClientSupervisor())
        <form method="POST" enctype="multipart/form-data" action="{{ route('add.employee') }}">
            @csrf
            @include('shared.errors')

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>{{ __('lang.add-employee-info') }}</strong>
                            </h2>
                        </div>

                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="name">{{ __('lang.employee-name') }}</label>

                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="email">{{ __('lang.employee-email-address') }}</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="national_id">{{ __('lang.national-id') }}</label>
                                        <input id="national_id" type="text" class="form-control" name="national_id"
                                            value="{{ old('national_id') }}" max="10">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="nationality">{{ __('lang.nationality') }}</label>
                                        <input id="nationality" type="text" class="form-control" name="nationality"
                                            value="{{ old('nationality') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="country">{{ __('lang.country') }}</label>
                                        <input id="country" type="text" class="form-control" name="country"
                                            value="{{ old('country') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label>{{ __('lang.gender') }}</label>
                                        <select class="form-control show-tick" name="gender">
                                            <option value="">-- {{ __('lang.please-select') }} --</option>
                                            <option value="female">{{ __('lang.female') }}</option>
                                            <option value="male">{{ __('lang.male') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="phone">{{ __('lang.phone') }}</label>
                                        <input id="phone" type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <label for="birth_date">{{ __('lang.birth-Of-date') }}</label>
                                        <input id="birth_date" type="date" class="form-control" name="birth_date"
                                            value="{{ old('birth_date') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <label for="password">{{ __('lang.password') }}</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <label for="password-confirm">{{ __('lang.confirm-password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-raised btn-primary waves-effect"
                                type="submit">{{ __('lang.add-new-employee') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
    @if (Auth::user()->isPTAdmin() or Auth::user()->isClientSupervisor())
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.list-of-employees') }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('lang.employee-name') }}</th>
                                        <th>{{ __('lang.national-id') }}</th>
                                        <th>{{ __('lang.phone') }}</th>
                                        <th>{{ __('lang.braclet-id') }}</th>
                                        <th>{{ __('lang.email') }}</th>
                                        <th>{{ __('lang.country') }}</th>
                                        <th>{{ __('lang.nationality') }}</th>
                                        <th>{{ __('lang.gender') }}</th>
                                        <th>{{ __('lang.birth-Of-date') }}</th>
                                        <th>{{ __('lang.created-at') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('lang.employee-name') }}</th>
                                        <th>{{ __('lang.national-id') }}</th>
                                        <th>{{ __('lang.phone') }}</th>
                                        <th>{{ __('lang.braclet-id') }}</th>
                                        <th>{{ __('lang.email') }}</th>
                                        <th>{{ __('lang.country') }}</th>
                                        <th>{{ __('lang.nationality') }}</th>
                                        <th>{{ __('lang.gender') }}</th>
                                        <th>{{ __('lang.birth-Of-date') }}</th>
                                        <th>{{ __('lang.created-at') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($clientEmployees ?? '' as $clientEmployee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $clientEmployee->user()->first()->name }}</td>
                                            <td>{{ $clientEmployee->user()->first()->national_id }}</td>
                                            <td>{{ $clientEmployee->user()->first()->phone }}</td>
                                            <td>
                                                @if($clientEmployee->user()->first()->braclet_id != NULL)
                                                    {{ $clientEmployee->user()->first()->braclet_id }}
                                                @else
                                                    <span style="color:red;">{{ __('lang.not-registered-yet') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $clientEmployee->user()->first()->email }}</td>
                                            <td>{{ $clientEmployee->user()->first()->country }}</td>
                                            <td>{{ $clientEmployee->user()->first()->nationality }}</td>
                                            <td>{{ $clientEmployee->user()->first()->gender }}</td>
                                            <td>{{ $clientEmployee->user()->first()->birth_date }}</td>
                                            <td>{{ $clientEmployee->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
