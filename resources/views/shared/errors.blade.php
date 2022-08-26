@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $err)
            - {{ $err }} <br />
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
        </button>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
        @php
        Session::forget('success');
        @endphp
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
        </button>
    </div>
@endif
