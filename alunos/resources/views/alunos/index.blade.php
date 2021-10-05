@extends('layout.base')
@section('title')

    Escola Laravel

@endsection
@section('page_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@endsection
@section('body')

    <h1>Alunos Cadastrados</h1>
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-error">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif

    <div class="ro  w">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Turma</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($listAlunos as $item)
                        <tr>

                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->email }}</td>
                            @foreach ($turmas as $turma)
                                @if ($turma->id == $item->turma_id)
                                    <td>{{ $turma->nome }}</td>
                                @endif
                            @endforeach
                            <td>
                                <div class="" style=" display: flex; justify-content:center;",>

                                    <button type="button" class="btn btn-info" style="margin-right: 10px"
                                        onclick="window.location.href='alunos/{{ $item->id }}/edit'"> Editar
                                    </button>

                                    <form action="/alunos/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Essa ação ira deletar o Aluno!')">Deletar</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('page_js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>

@endsection
