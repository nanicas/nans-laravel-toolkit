@extends('layouts.config.index')
@section('config-content')

    @include('components.form', compact('data', 'status', 'message', 'screen'))

@endsection