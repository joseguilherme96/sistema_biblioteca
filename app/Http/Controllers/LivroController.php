<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\LivroModel;
use Exception;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LivroController extends Controller
{

    public function index(){

        return Inertia::render('Livro/CadastroLivro', [
            'status' => session('status')
        ]);

    }

    public function uploadCapaLivro($request, $nome_livro)
    {

        $nomeParaSalvar = '';

        //Verifica se veio arquivo em anexo
        if ($request->hasFile('capaLivro')) {

            $extensaoImagem = $request->file('capaLivro')->getClientOriginalExtension();

            $nomeParaSalvar = strtolower(str_replace(" ", "_", $nome_livro));

            $nomeParaSalvar = "cpa_lvro_" . $nomeParaSalvar . "_" . time() . "." . $extensaoImagem;

            $request->file('capaLivro')->storeAs('imagens', $nomeParaSalvar, 'public');


            if (strlen($nomeParaSalvar) > 100) {

                return redirect()->back()->with('error', 'O nome da capa do livro gerado excedeu o limite de caracteres !');
            }
        }

        return $nomeParaSalvar;
    }

    public function salvar(LivroRequest $request)
    {

        try {

            $validated = $request->validated();

            $livroModel = new LivroModel();

            $livroModel->nome = $validated['nomeLivro'];
            $livroModel->categoria = $validated['categoriaLivro'];
            $livroModel->autor = $validated['autorLivro'];
            $livroModel->descricao = $validated['descricaoLivro'];

            //Faz upload do livro e retorna nome da imagem gerada
            $livroModel->nme_img_cap_lvro = $this->uploadCapaLivro($request, $validated['nomeLivro']);

            $livroModel->save();

            return redirect()->back()->with('success', 'O livro foi cadastrado com sucesso!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Falha ao cadastrar o livro !');
        }
    }

    public function atualizar($id, LivroRequest $request)
    {
        try {

            $validated = $request->validated();

            $livroModel = new LivroModel();

            $livro = $livroModel->find($id);

            $livro->nome = $validated['nomeLivro'];
            $livro->categoria = $validated['categoriaLivro'];
            $livro->autor = $validated['autorLivro'];
            $livro->descricao = $validated['descricaoLivro'];

            //Faz upload do livro e retorna nome da imagem gerada
            $livroModel->nme_img_cap_lvro = $this->uploadCapaLivro($request, $validated['nomeLivro']);

            $livro->save();

            return redirect()->back()->with('success', 'O livro foi alterado com sucesso!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Falha ao alterar o livro !');
        }
    }
}
