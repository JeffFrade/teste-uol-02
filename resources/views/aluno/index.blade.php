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
                            <a href="#" class="btn btn-light"><i class="fa fa-plus"></i>&nbsp; Cadastrar Aluno</a>
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
                                        <a href="#" class="btn btn-light btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
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
