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

    public function salvar(LivroRequest $request)
    {

        try {

            $validated = $request->validated();

            $livroModel = new LivroModel();

            $livroModel->nome = $validated['nomeLivro'];
            $livroModel->categoria = $validated['categoriaLivro'];
            $livroModel->autor = $validated['autorLivro'];
            $livroModel->descricao = $validated['descricaoLivro'];

            //Verifica se veio arquivo em anexo
            if ($request->hasFile('capaLivro')) {

                $extensaoImagem = $request->file('capaLivro')->getClientOriginalExtension();

                $nomeParaSalvar = strtolower(str_replace(" ", "_", $livroModel->nome));

                $nomeParaSalvar = "cpa_lvro_".$nomeParaSalvar."_".time(). "." . $extensaoImagem;

                $request->file('capaLivro')->storeAs('imagens', $nomeParaSalvar, 'public');
                
                $livroModel->nme_img_cap_lvro = $nomeParaSalvar;
            }

            

            $livroModel->save();

            return redirect()->back()->with('success', 'O livro foi cadastrado com sucesso!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Falha ao cadastrar o livro !');
        }
    }
}
