@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')
    <h1 class="m-0 text-dark">Alunos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{ Form::open(['method' => 'GET', 'route' => 'alunos.index']) }}
                <div class="card-header bg-secondary">
                    <div class="row">
                        <div class="col-md-9">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Nome/E-mail" value="{{ $params['search'] ?? '' }}">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-filter"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                            &nbsp;
                            <a href="{{ route('alunos.create') }}" class="btn btn-light"><i class="fa fa-plus"></i>&nbsp; Cadastrar Aluno</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->nome }}</td>
                                    <td>{{ $aluno->email }}</td>
                                    <td style="width: 1%" nowrap="">
                                        <a href="{{ route('alunos.edit', ['id' => $aluno->id]) }}" class="btn btn-light btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
                                        &nbsp;
                                        <a href="#" class="btn btn-danger btn-xs btn-del" data-id="{{ $aluno->id }}" title="Excluir"><i class="fa fa-trash"></i></a>
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
                    {!! \App\Helpers\PaginateHelper::paginateWithParams($alunos, $params) !!}
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
            if (confirm('Deseja excluir o aluno?')) {
                $.ajax({
                    contentType: 'application/x-www-form-urlencoded',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    method: 'DELETE',
                    url: 'alunos/delete/' + $(this).data('id'),
                    timeout: 0,
                    success: function (response) {
                        $.notify({message: response.message}, {type: 'success'});
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (err) {
                        $.notify({message: err.error}, {type: 'danger'});
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
