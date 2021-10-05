<?php

namespace App\Http\Controllers;

use App\Models\aluno;
use App\Models\turma;
use App\Http\Requests\CreateValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('alunos.index')->with('listAlunos', aluno::all())->with('turmas', turma::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('alunos.create')->with('turmas', turma::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateValidationRequest $request)
    {
        DB::beginTransaction();

        $request->validated();

        try {

            $alunos = new aluno();
            $alunos->nome = $request->input('nome');
            $alunos->email = $request->input('email');
            $alunos->turma_id =  $request->get('turma');

            if ($request->image == null) {
                $alunos->image_path = null;
            } else {
                $newImage = time() . '-' . $request->image->extension();
                $alunos->image_path = $request->image->move(public_path('images'), $newImage);
            }
            $alunos->save();

            DB::commit();

            return redirect('/alunos')->with('success', "Aluno cadastrado com Sucesso");
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('/alunos')->withErrors('error', "Houve um erro ao Cadastrar o aluno");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('alunos.view')->with($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alunos = aluno::find($id);
        return view('alunos.edit')->with('alunos', $alunos)->with('turmas', turma::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateValidationRequest $request, $id)
    {
        $newImage = null;

        try {
            if ($request->image == null) {
                $newImage = null;
                $request->validated();
                
                $aluno = aluno::where('id', $id)->update([
                    'nome' => $request->input('nome'),
                    'email' => $request->input('email'),
                    'turma_id' => $request->get('turma')
    
                ]);
                return redirect('/alunos')->with('success', 'Aluno editado com sucesso');
    
            } else {
                $request->validated();
                $newImage = time() . '-' . 'img';
                $request->image->move(public_path('images'), $newImage);
                $aluno = aluno::where('id', $id)->update([
                    'nome' => $request->input('nome'),
                    'email' => $request->input('email'),
                    'turma_id' => $request->get('turma'),
                    'image_path' => $newImage
    
                ]);
                return redirect('/alunos')->with('success', 'Aluno editado com sucesso');
            }
        } catch (\Throwable $th) {
            return redirect('/alunos')->with('error', 'Ocorreu um erro ao editar aluno');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alunos = aluno::find($id);

        $alunos->delete();

        return redirect('/alunos')->with('success', 'Aluno deletado com sucesso');
    }
}
