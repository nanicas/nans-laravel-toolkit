@if(!empty($message))
    <div class="alert alert-info">{!! $message !!}</div>
@endif

@if(isset($state))
    @include('layouts.crud.messages-state', ['state' => $state])
@endif

@if(!isset($status) || $status === true)

    <div id="form-result-box"></div>

    @if(isset($data['row']) && !empty($data['row']))
        @php $id = $data['row']->getId(); @endphp
        <form id="crud-form" action="{{ route($screen.'.update', $id ) }}" method="POST">
            @method('PUT')
            <input type="hidden" name="id" value="{{ $id }}"/>
    @else
        <form id="crud-form" action="{{ route($screen.'.store') }}" method="POST">
    @endif
        @csrf

        @yield('crud-form-content')

        <hr>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <button type="submit" data-style="expand-right" class="btn btn-success ladda-button">
                        <span class="ladda-label">Salvar cadastro</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endif