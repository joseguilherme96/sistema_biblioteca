<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtendimentoItemReservaModel;
use Exception;
use Inertia\Inertia;

class AtendimentoItemReserva extends Controller
{

    public function salvar(Request $request)
    {
        try {

            $validated = $request->all();

            foreach ($validated['itens_para_baixa'] as $key => $item) {

                $atendimentoItemReservadoModel = new AtendimentoItemReservaModel();

                $atendimentoItemReservadoModel->item_reserv_id = $item['id_item_reserva'];
                $atendimentoItemReservadoModel->status_id = 1;
                $atendimentoItemReservadoModel->user_id = $item['id_usuario'];
                $atendimentoItemReservadoModel->quantidade_separada = $item['quantidade_para_baixa'];
                $atendimentoItemReservadoModel->data_devolucao = $item['data_devolucao_utc'];
                $atendimentoItemReservadoModel->save();
            }


            return redirect()->back()->with('success', 'O atendimento foi realizado com sucesso !');
            
        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Falha ao atendimento da reserva !');
        }
    }
}
