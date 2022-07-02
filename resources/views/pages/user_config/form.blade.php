@extends('layouts.crud.form')
@section('crud-form-content')

@if(isset($state))
    @include('layouts.crud.messages-state', ['state' => $state])
@endif

@if($status === true)

    @php
        extract($data);
        $isUpdate = (isset($data['row']) && !empty($data['row']));
    @endphp

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Apelido</th>
                @if($isMaster)
                    <th>Admin</th>
                @endif
                @if($isUpdate)
                    <th>Criação</th>
                    <th>Atualização</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input name="name" value="{{ ($isUpdate) ? $data['row']->getName() : '' }}" /></td>
                @if($isMaster)
                    <td><input {{ ($isUpdate && $data['row']->isAdmin()) ? 'checked' : '' }} type="checkbox" name="admin" value="1" /></td>
                @endif
                @if($isUpdate)
                    <td>{{ $data['row']->getCreatedAt() }}</td>
                    <td>{{ $data['row']->getUpdatedAt() }}</td>
                @endif
            </tr>
        </tbody>
    </table>

@endif
@endsection