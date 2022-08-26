@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('lang.employees') }}
@endsection

@section('content')

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
                                        <th>{{ __('lang.braclet-id') }}</th>
                                        <th>{{ __('lang.temperature') }}</th>
                                        <th>{{ __('lang.heart-rate') }}</th>
                                        <th>{{ __('lang.oxygen-level') }}</th>
                                        <th>{{ __('lang.blood-pressure') }}</th>
                                        <th>{{ __('lang.created-at') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('lang.employee-name') }}</th>
                                        <th>{{ __('lang.braclet-id') }}</th>
                                        <th>{{ __('lang.temperature') }}</th>
                                        <th>{{ __('lang.heart-rate') }}</th>
                                        <th>{{ __('lang.oxygen-level') }}</th>
                                        <th>{{ __('lang.blood-pressure') }}</th>
                                        <th>{{ __('lang.created-at') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($clientEmployees ?? '' as $employeeBraceletTracker)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employeeBraceletTracker->name }}</td>
                                        <td>{{ $employeeBraceletTracker->braclet_id }}</td>
                                        <td>{{ $employeeBraceletTracker->temperature }}</td>
                                        <td>{{ $employeeBraceletTracker->heart_beat }}</td>
                                        <td>{{ $employeeBraceletTracker->oxygen_level }}</td>
                                        <td>{{ $employeeBraceletTracker->blood_pressure }}</td>
                                        <td>{{ $employeeBraceletTracker->created_at }}</td>
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
