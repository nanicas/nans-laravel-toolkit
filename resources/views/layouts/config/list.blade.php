@extends('layouts.config.index')
@section('config-content')
    @include($view_prefix . 'components.list', compact('state', 'rows', 'config', 'screen'))
@endsection