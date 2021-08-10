@extends('adminlte::page')

@section('title', 'Editar Curso')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Curso</h1>
@stop

@section('content')
    <div class="card">
        {{ Form::open(['method' => 'PUT', 'route' => ['cursos.update', 'id' => $curso->id]]) }}
        <div class="card-header bg-secondary">
            <h3 class="card-title"><i class="fa fa-plus"></i>&nbsp; Cadastrar Curso</h3>
        </div>

        <div class="card-body">
            @include('curso._form')
        </div>

        <div class="card-footer">
            <a href="{{ route('cursos.index') }}" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; Cancelar</a>

            <button type="submit" class="btn btn-primary pull-right btn-save"><i class="fa fa-save"></i>&nbsp; Salvar</button>
        </div>
        {{ Form::close() }}

        @include('util.overlay')
    </div>
@stop
