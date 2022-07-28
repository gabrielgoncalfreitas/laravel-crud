<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function home_index()
    {
        return view('home');
    }

    public function estoque_index()
    {
        $item = Estoque::all();

        return view('estoque', [
            'item' => $item->sortBy('description')
        ]);
    }

    public function itemCreate(Request $r)
    {
        $estoque = new Estoque();

        $estoque->description = $r->input('description');
        $estoque->quantity    = $r->input('quantity');
        $estoque->price       = $r->input('price');

        $estoque->save();

        return redirect('/estoque');
    }

    public function itemUpdate($id, Request $r)
    {

        $estoque = new Estoque();

        $estoque->description = $r->input('description');
        $estoque->quantity    = $r->input('quantity');
        $estoque->price       = $r->input('price');

        Estoque::where('id', $id)->update([
            'description' => $estoque->description,
            'quantity'    => $estoque->quantity,
            'price'       => $estoque->price
        ]);

        return redirect('/estoque');
    }

    public function itemDelete($id)
    {
        Estoque::where('id', $id)->delete();

        return redirect('/estoque');
    }
}
