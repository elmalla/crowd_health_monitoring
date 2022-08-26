@extends('layouts.dasboard')

@section('pagename-navbar')
{{ __('lang.employees') }}
@endsection

@section('content')
    @if (Auth::user()->isClientSupervisor())
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
                                            <td>{{ $clientEmployee->name }}</td>
                                            <td>{{ $clientEmployee->national_id }}</td>
                                            <td>{{ $clientEmployee->phone }}</td>
                                            <td>
                                                @if($clientEmployee->braclet_id != NULL)
                                                    {{ $clientEmployee->braclet_id }}
                                                @else
                                                    <span style="color:red;">{{ __('lang.not-registered-yet') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $clientEmployee->email }}</td>
                                            <td>{{ $clientEmployee->country }}</td>
                                            <td>{{ $clientEmployee->nationality }}</td>
                                            <td>{{ $clientEmployee->gender }}</td>
                                            <td>{{ $clientEmployee->birth_date }}</td>
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
