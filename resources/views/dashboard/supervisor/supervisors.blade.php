@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('lang.supervisors') }}
@endsection

@section('content')
    @if (Auth::user()->isClientSupervisor())
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                @include('shared.errors')

                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.assign-employee-to-be-supervisor') }}</strong></h2>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST" action="{{ route('add.client_supervisor') }}">
                            @csrf
                            <div class="form-group form-float">
                                <label>{{ __('Supervisor') }}</label>
                                <select class="form-control show-tick" name="user_id">
                                    <option value="">-- {{ __('lang.please-select') }} --</option>
                                    @foreach ($clientEmployees ?? '' as $clientEmployee)
                                        <option value="{{ $clientEmployee->user()->first()->id }}">
                                            {{ $clientEmployee->user()->first()->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-raised btn-primary waves-effect"
                                type="submit">{{ __('lang.add-supervisor') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->isPTAdmin() or Auth::user()->isClientSupervisor())
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>{{ __('lang.list-of-supervisor') }}</strong></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('lang.supervisor-name') }}</th>
                                        <th>{{ __('lang.email') }}</th>
                                        <th>{{ __('lang.phone') }}</th>
                                        <th>{{ __('lang.country') }}</th>
                                        <th>{{ __('lang.nationality') }}</th>
                                        <th>{{ __('lang.national-id') }}</th>
                                        <th>{{ __('lang.gender') }}</th>
                                        <th>{{ __('lang.birth-Of-date') }}</th>
                                        <th>{{ __('lang.created-at') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('lang.supervisor-name') }}</th>
                                        <th>{{ __('lang.email') }}</th>
                                        <th>{{ __('lang.phone') }}</th>
                                        <th>{{ __('lang.country') }}</th>
                                        <th>{{ __('lang.nationality') }}</th>
                                        <th>{{ __('lang.national-id') }}</th>
                                        <th>{{ __('lang.gender') }}</th>
                                        <th>{{ __('lang.birth-Of-date') }}</th>
                                        <th>{{ __('lang.created-at') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($clientSupervisors ?? '' as $clientSupervisor)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->name }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->email }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->phone }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->country }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->nationality }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->national_id }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->gender }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->birth_date }}</td>
                                            <td>{{ $clientSupervisor->user()->first()->created_at }}</td>
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
