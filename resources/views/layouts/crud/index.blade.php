@extends($view_prefix . 'layouts.dashboard', compact('screen'))
@section('dashboard-content')

<div class="card">
    <div class="card-body">
        <form id="filter-form" action="{{ route('scheduling.filter') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cmm_age_tipo_servico">Serviço</label>
                    <select class="form-control" name="cmm_age_tipo_servico">
                        @php $i = 0; @endphp
                        @forelse($types as $type)
                            @if($i++ == 0)
                                <option value="0">Todos</option>
                            @endif
                            <option value="{{ $type->getId() }}">{{ $type->getDescription() }}</option>
                        @empty
                            <option value="0">Nenhum tipo de serviço cadastrado</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="cmm_age_id_usuario">ID usuário</label>
                    <input type="numeric" class="form-control" name="cmm_age_id_usuario">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="cmm_age_observacoes">Observação</label>
                    <textarea class="form-control" name="cmm_age_observacoes" placeholder="Digite aqui ..."></textarea>
                </div>
                <div class="form-group col-md-4 dates-box">
                    <label for="cmm_age_data_cadastro">Data de cadastro</label>
                    <input autocomplete="off" type="text" class="form-control" name="cmm_age_data_cadastro">
                </div>
            </div>
            <div class="form-row dates-box">
                <div class="form-group col-md-4">
                    <label for="cmm_age_data">Data de agendamento</label>
                    <input autocomplete="off" type="text" class="form-control" name="cmm_age_data">
                </div>
                <div class="form-group col-md-4">
                    <label for="cmm_age_data_finalizado">Data de encerramento</label>
                    <input autocomplete="off" type="text" class="form-control" name="cmm_age_data_finalizado">
                </div>
                <div class="form-group col-md-4">
                    <label for="cmm_age_data_cancelamento">Data de cancelamento</label>
                    <input autocomplete="off" type="text" class="form-control" name="cmm_age_data_cancelamento">
                </div>
            </div>
            <div class="form-row float-right text-center">
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" name="nao-cancelados" id="nao-cancelados" value="1">
                    <label class="form-check-label" for="nao-cancelados">
                        Não foram cancelados
                    </label>
                </div>
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" name="nao-finalizados" id="nao-finalizados" value="1">
                    <label class="form-check-label" for="nao-finalizados">
                        Não foram encerrados
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-info">Buscar agendamentos</button>
        </form>
    </div>
</div>
<hr>

<div id="filter-loading" class="loading none">Filtrando ...</div>

<div class="card none" id="schedulings-list-box">
    <div class="card-body"></div>
</div>

<div class="modal fade" id="scheduling-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalhes do agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>
@endsection