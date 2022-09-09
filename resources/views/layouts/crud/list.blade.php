@extends('layouts.dashboard')
@section('dashboard-content')
    @include('components.list', compact('state', 'rows', 'config', 'screen'))
@endsection