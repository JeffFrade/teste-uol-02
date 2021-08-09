@extends('adminlte::page')

@section('title', 'Alunos')

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
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ $params['name'] ?? '' }}">
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Data" value="{{ $params['date'] ?? '' }}">
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-filter"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                            &nbsp;
                            <a href="#" class="btn btn-light"><i class="fa fa-plus"></i>&nbsp; Cadastrar Curso</a>
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
                                    <a href="#" class="btn btn-light btn-xs" title="Editar"><i class="fa fa-edit"></i></a>
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
