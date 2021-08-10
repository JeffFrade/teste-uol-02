@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1 class="m-0 text-dark">Cursos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{ Form::open(['method' => 'GET', 'route' => 'cursos.index']) }}
                <div class="card-header bg-secondary">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="name">Nome:</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ $params['name'] ?? '' }}">
                        </div>

                        <div class="col-md-4">
                            <label for="date">Data:</label>
                            <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Data" value="{{ $params['date'] ?? '' }}">
                        </div>

                        <div class="col-md-3 margin-form">
                            <button type="submit" class="btn btn-primary btn-filter"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                            &nbsp;
                            <a href="{{ route('cursos.create') }}" class="btn btn-light"><i class="fa fa-plus"></i>&nbsp; Cadastrar Curso</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data de Início</th>
                            <th>Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $curso->nome }}</td>
                                <td>{{ \App\Helpers\DateHelper::formatDateWithoutCarbon($curso->data_inicio, 'd/m/Y - H:i') }}</td>
                                <td style="width: 1%" nowrap="">
                                    <a href="{{ route('cursos.edit', ['id' => $curso->id]) }}" class="btn btn-light btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                    &nbsp;
                                    <a href="#" class="btn btn-danger btn-xs btn-del" data-id="{{ $curso->id }}" title="Excluir"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Não há dados</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {!! \App\Helpers\PaginateHelper::paginateWithParams($cursos, $params) !!}
                </div>
                {{ Form::close() }}

                @include('util.overlay')
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $('.btn-del').on('click', function (e) {
            e.preventDefault();
            $('.overlay').removeClass('overlay-hidden');
            if (confirm('Deseja excluir o curso?')) {
                $.ajax({
                    contentType: 'application/x-www-form-urlencoded',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    method: 'DELETE',
                    url: 'cursos/delete/' + $(this).data('id'),
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

