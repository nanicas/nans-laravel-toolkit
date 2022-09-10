@extends($view_prefix . 'layouts.dashboard')
@section('dashboard-content')

    @include($view_prefix . 'components.form', compact('data', 'status', 'message', 'screen'))

@endsection