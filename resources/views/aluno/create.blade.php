@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Cadastrar Aluno</h1>
@stop

@section('content')
    <div class="card">
        {{ Form::open(['method' => 'POST', 'route' => 'alunos.store']) }}
        <div class="card-header bg-secondary">
            <h3 class="card-title"><i class="fa fa-user-plus"></i>&nbsp; Cadastrar Aluno</h3>
        </div>

        <div class="card-body">
            @include('aluno._form')
        </div>

        <div class="card-footer">
            <a href="{{ route('alunos.index') }}" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp; Cancelar</a>

            <button type="submit" class="btn btn-primary pull-right btn-save"><i class="fa fa-save"></i>&nbsp; Salvar</button>
        </div>
        {{ Form::close() }}

        @include('util.overlay')
    </div>
@stop
