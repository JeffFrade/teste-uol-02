@extends('adminlte::page')

@section('title', 'Matrículas')

@section('content_header')
    <h1 class="m-0 text-dark">Matrículas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{ Form::open(['method' => 'GET', 'route' => 'matriculas.index']) }}
                <div class="card-header bg-secondary">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="id_aluno">Aluno:</label>
                            <select id="id_aluno" name="id_aluno" class="form-control select2">
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" {{ (($params['id_aluno'] ?? '') == $aluno->id?'selected="selected"':'') }}>{{ $aluno->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="id_curso">Curso:</label>
                            <select id="id_curso" name="id_curso" class="form-control select2">
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ (($params['id_curso'] ?? '') == $curso->id?'selected="selected"':'') }}>{{ $curso->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="status">Status:</label>
                            <select id="status" name="status" class="form-control select2">
                                <option value="1" {{ (($params['status'] ?? '') == 1?'selected="selected"':'') }}>Ativo</option>
                                <option value="0" {{ (($params['status'] ?? '') == 0?'selected="selected"':'') }}>Inativo</option>
                            </select>
                        </div>

                        <div class="col-md-4 margin-form">
                            <a href="#" class="btn btn-danger btn-clear"><i class="fa fa-times"></i>&nbsp; Limpar</a>
                            &nbsp;
                            <button type="submit" class="btn btn-primary btn-filter"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                            &nbsp;
                            <a href="#" class="btn btn-light"><i class="fa fa-plus"></i>&nbsp; Cadastrar Matrícula</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Curso</th>
                            <th>Status</th>
                            <th>Data de Admissão</th>
                            <th>Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($matriculas as $matricula)
                            <tr>
                                <td>{{ $matricula->aluno->nome }}</td>
                                <td>{{ $matricula->curso->nome }}</td>
                                <td>{!! \App\TypeLabels\StatusValue::label($matricula->ativo) !!}</td>
                                <td>{{ \App\Helpers\DateHelper::formatDateWithoutCarbon($matricula->data_admissao, 'd/m/Y - H:i') }}</td>
                                <td style="width: 1%" nowrap="">
                                    @if($matricula->ativo == 1)
                                        <a href="#" class="btn btn-danger btn-xs btn-status" title="Desativar Matrícula" data-id="{{ $matricula->id }}"><i class="fa fa-ban"></i></a>
                                    @else
                                        <a href="#" class="btn btn-success btn-xs btn-status" title="Ativar Matrícula" data-id="{{ $matricula->id }}"><i class="fa fa-check"></i></a>
                                    @endif
                                    &nbsp;
                                    <a href="#" class="btn btn-light btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                    &nbsp;
                                    <a href="#" class="btn btn-danger btn-xs btn-del" data-id="{{ $matricula->id }}" title="Excluir"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Não há dados</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {!! \App\Helpers\PaginateHelper::paginateWithParams($matriculas, $params) !!}
                </div>
                {{ Form::close() }}

                @include('util.overlay')
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $('.btn-clear').on('click', function (e) {
            e.preventDefault();

            $(document).find('input').val('');
            $(".select2").val(null).trigger("change");
        });

        $('.btn-status').on('click', function (e) {
            e.preventDefault();
            $('.overlay').removeClass('overlay-hidden');
            if (confirm('Deseja alterar o status da matrícula?')) {
                $.ajax({
                    contentType: 'application/x-www-form-urlencoded',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    method: 'PUT',
                    url: 'matriculas/update-status/' + $(this).data('id'),
                    timeout: 0,
                    success: function (response) {

                        $.notify({message: response.message}, {type: 'success'});
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (err) {
                        $.notify({message: err.error ?? 'Ocorreu um erro, favor consultar a TI'}, {type: 'danger'});
                        console.error(err);
                        $('.overlay').addClass('overlay-hidden');
                    }
                });
            } else {
                $('.overlay').addClass('overlay-hidden');
            }
        });
    </script>
@stop
