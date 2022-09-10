@extends($view_prefix . 'layouts.dashboard')
@section('dashboard-content')
    @include($view_prefix . 'components.list', compact('state', 'rows', 'config', 'screen'))
@endsection