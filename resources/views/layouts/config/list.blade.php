@extends($view_prefix . 'layouts.config.index')
@section('config-content')
    @include('components.list', compact('state', 'rows', 'config', 'screen'))
@endsection