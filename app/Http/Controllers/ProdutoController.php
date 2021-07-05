<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Produto as ProdutoResource;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info("Produtos listados");
        $produtos = Produto::paginate(10);
        return ProdutoResource::collection($produtos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = new Produto;
        $produto->codigo = $request->input('codigo');
        $produto->nome = $request->input('nome');
        $produto->composicao = $request->input('composicao');
        $produto->tamanho = $request->input('tamanho');
        $produto->quantidade = $request->input('quantidade');

        if ($produto->save()) {
            Log::info("Novo produto criado - codigo: {$produto->codigo}");
            return new ProdutoResource($produto);
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
        $produto = Produto::findOrFail($id);
        return new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->codigo = $request->input('codigo');
        $produto->nome = $request->input('nome');
        $produto->composicao = $request->input('composicao');
        $produto->tamanho = $request->input('tamanho');
        $produto->quantidade = $request->input('quantidade');

        if($produto->save()){
            Log::info("Produto alterado - codigo: {$produto->codigo}");
            return new ProdutoResource($produto);
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
        $produto = Produto::findOrFail($id);
        if($produto->delete()){
            Log::info("Produto deletado - codigo: {$produto->codigo}");
            return new ProdutoResource( $produto );
        }
    }
}
