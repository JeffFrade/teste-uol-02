@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{ $indiceAlunos }}</h3>

                    <p>Alunos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('alunos.index') }}" class="small-box-footer">Mais Informações &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop
