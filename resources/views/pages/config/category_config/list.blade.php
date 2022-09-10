@extends($view_prefix . 'layouts.config.list')
@section('crud-content')

<table class="table table-bordered table-sm table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Chave</th>
            <th>Ativo</th>
            <th>Data cadastro</th>
            <th>Data atualização</th>
            <th></th>
        <tr>
    </thead>
    <tbody>
        @foreach($rows as $category)
        <tr>
            <td>{{ $category->getId() }}</td>
            <td>{{ $category->getName() }}</td>
            <td>{{ $category->getKey() }}</td>
            <td>
                @if($category->isActive())
                <span class="badge badge-success">Ativo</span>
                @else
                <span class="badge badge-danger">Inativo</span>
                @endif
            </td>
            <td>{{ $category->getCreatedAt() }}</td>
            <td>{{ $category->getUpdatedAt() }}</td>
            <td class="text-center">
                <a class="btn btn-info" href="{{ route('category_config.show', $category->getId()) }}">
                    Editar
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection