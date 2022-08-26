@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('Bracelete Type') }}
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @include('shared.errors')

            <div class="card">
                <div class="header">
                    <h2><strong>{{ __('Add New Bracelete Type') }}</strong></h2>
                </div>
                <div class="body">
                    <form id="form_validation" method="POST" action="{{ route('add.bracelettype') }}">
                        @csrf
                        <div class="form-group form-float">
                            <label>{{ __('Bracelete Type Name') }}</label>
                            <input type="text" class="form-control" name="vendor_name">
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect"
                            type="submit">{{ __('Add New Bracelete Type') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>List of Bracelete Type</strong></h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover c_table theme-color">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name of Bracelete type') }}</th>
                                <th>{{ __('Created at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bracelettypes ?? '' as $bracelettype)
                                <tr>
                                    <td>{{ $bracelettype->id }}</td>
                                    <td>{{ $bracelettype->vendor_name }}</td>
                                    <td>{{ $bracelettype->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <ul class="pagination pagination-primary mt-4">
                    <li class="page-item">{{ $bracelettypes->links() }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
