@extends('layouts.config.list')
@section('crud-content')
<table class="table table-bordered table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Componente</th>
            <th>Situação</th>
            <th>Data cadastro</th>
            <th>Data atualização</th>
            <th></th>
        <tr>
    </thead>
    <tbody>
        @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->getId() }}</td>
            <td>{{ $entity->getName() }}</td>
            <td>{{ $entity->component?->name }}</td>
            <td><span class="badge badge-{{ ($entity->isActive()) ? 'success' : 'danger' }}">Ativo</span></td>
            <td>{{ $entity->getCreatedAt() }}</td>
            <td>{{ $entity->getUpdatedAt() }}</td>
            <td class="text-center">
                <a class="btn btn-info" href="{{ route('entity_config.show', $entity->getId()) }}">
                    Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection