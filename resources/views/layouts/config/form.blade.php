@extends('layouts.config.index')
@section('config-content')

    @include($view_prefix . 'components.form', compact('data', 'status', 'message', 'screen'))

@endsection