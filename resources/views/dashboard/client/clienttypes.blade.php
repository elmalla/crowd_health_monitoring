@extends('layouts.dasboard')

@section('pagename-navbar')
    {{ __('Client Type') }}
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @include('shared.errors')

            <div class="card">
                <div class="header">
                    <h2><strong>{{ __('Add New Client Type') }}</strong></h2>
                </div>
                <div class="body">
                    <form id="form_validation" method="POST" action="{{ route('add.client_type') }}">
                        @csrf
                        <div class="form-group form-float">
                            <label>{{ __('Client Type Name') }}</label>
                            <input type="text" class="form-control" name="type_name">
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect"
                            type="submit">{{ __('Add New Client Type') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>List of Client Type</strong></h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover c_table theme-color">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name of Client type') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clienttypes ?? '' as $clienttype)
                                <tr>
                                    <td>{{ $clienttype->id }}</td>
                                    <td>{{ $clienttype->type_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <ul class="pagination pagination-primary mt-4">
                    <li class="page-item">{{ $clienttypes->links() }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
