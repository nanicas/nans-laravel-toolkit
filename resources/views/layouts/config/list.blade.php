@extends('layouts.config.index')
@section('config-content')
    @include('components.list', compact('state', 'rows', 'config', 'screen'))
@endsection