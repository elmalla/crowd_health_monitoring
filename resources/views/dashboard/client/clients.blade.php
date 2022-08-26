@extends('layouts.dasboard')

@section('pagename-navbar')
    Clients
@endsection

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('add.client') }}">
        @csrf

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                @include('shared.errors')
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('Add New Client') }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('Client Name') }}</label>
                                    <input type="text" class="form-control" name="name_client"
                                        value="{{ old('name_client') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('Country') }}</label>
                                    <input type="text" class="form-control" name="country_client"
                                        value="{{ old('country_client') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('City') }}</label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('E-mail') }}</label>
                                    <input type="email" class="form-control" name="email_client"
                                        value="{{ old('email_client') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" class="form-control" name="phone_client"
                                        value="{{ old('phone_client') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('Employees Total') }}</label>
                                    <input type="number" class="form-control" name="employee_total"
                                        value="{{ old('employee_total') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('website') }}</label>
                                    <input type="url" class="form-control" name="website" value="{{ old('website') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('Client Type') }}</label>
                                    <select class="form-control show-tick" name="clienttype_id">
                                        <option value="">-- Please select --</option>
                                        @foreach ($clienttypes ?? '' as $clienttype)
                                            <option value="{{ $clienttype->id }}">{{ $clienttype->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <input type="file" name="file" id="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>{{ __('Add Client Supervisor Info') }}</strong>
                        </h2>
                    </div>

                    <div class="body">

                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="name">{{ __('Supervisor Client Name') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="email">{{ __('Supervisor Client E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="country">{{ __('Country') }}</label>
                                    <input id="country" type="text" class="form-control" name="country"
                                        value="{{ old('country') }}" max="10">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="national_id">{{ __('National ID') }}</label>
                                    <input id="national_id" type="text" class="form-control" name="national_id"
                                        value="{{ old('national_id') }}" max="10">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="nationality">{{ __('Nationality') }}</label>
                                    <input id="nationality" type="text" class="form-control" name="nationality"
                                        value="{{ old('nationality') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label>{{ __('Gender') }}</label>
                                    <select class="form-control show-tick" name="gender">
                                        <option value="">-- Please select --</option>
                                        <option value="female">female</option>
                                        <option value="male">male</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="phone">{{ __('phone') }}</label>
                                    <input id="phone" type="text" class="form-control" name="phone"
                                        value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-float">
                                    <label for="birth_date">{{ __('Birth Of Date') }}</label>
                                    <input id="birth_date" type="date" class="form-control" name="birth_date"
                                        value="{{ old('birth_date') }}">
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-raised btn-primary waves-effect"
                            type="submit">{{ __('Add New Client') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>List of Clients</strong></h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Employee Total</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Client Type</th>
                                    <th>Supervisors</th>
                                    <th>Employees</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Employee Total</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Client Type</th>
                                    <th>Supervisors</th>
                                    <th>Employees</th>
                                    <th>Created at</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($clients ?? '' as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>
                                            @if ($client->logo)
                                                <img class="rounded avatar" src="storage/{{ $client->logo }}" alt="logo">
                                            @else
                                                <img class="rounded avatar" src="assets/images/xs/avatar1.jpg" alt="logo">
                                            @endif
                                            <br />
                                            {{ $client->name }}
                                        </td>
                                        <td>{{ $client->country }}</td>
                                        <td>{{ $client->city }}</td>
                                        <td>{{ $client->employee_total }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td><a href="{{ $client->website }}">{{ $client->website }}</a></td>
                                        <td>{{ $client->clientType()->first()->type_name }}</td>
                                        <td><a href="{{ route('admin.show_client_supervisors', $client->id) }}">Supervisors
                                                List</a></td>
                                        <td><a href="{{ route('admin.show_client_employees', $client->id) }}">Employees
                                                List</a></td>
                                        {{-- <td><a
                                                href="clientemployees/{{ $client->id }}">Employees List</a></td>
                                        --}}
                                        <td>{{ $client->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
