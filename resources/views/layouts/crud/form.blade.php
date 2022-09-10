@extends($view_prefix . 'layouts.dashboard')
@section('dashboard-content')

    @include('components.form', compact('data', 'status', 'message', 'screen'))

@endsection