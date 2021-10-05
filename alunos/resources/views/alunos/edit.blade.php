@extends('layout.base')
@section('title')

    Escola Laravel

@endsection

@section('body')
@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif
    <form action="/alunos/{{ $alunos->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <h1>Editar Alunos</h1>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $alunos->nome }}"
                    placeholder="Digite seu nome">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $alunos->email }}"
                    placeholder="Digite seu email">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Turma</label>

                <select class="form-select" id="turma" name="turma">
                    @foreach ($turmas as $item)
                        <option @if ($alunos->turma_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

    @if ($errors->any())
        <div class="w-4/8 m-auto text-center">
            @foreach ($errors->all() as $error)
                <li class="text-red-500 list-none" style="color: red"> {{ $error }} </li>
            @endforeach
        </div>
    @endif
@endsection
