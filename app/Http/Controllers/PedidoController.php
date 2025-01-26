<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function insertarRegistros()
    {
        Usuario::create(['nombre' => 'Roberto', 'email' => 'roberto@mail.com']);
        Usuario::create(['nombre' => 'Carlos', 'email' => 'carlos@mail.com']);
        Usuario::create(['nombre' => 'Rosa', 'email' => 'rosa@mail.com']);
        Usuario::create(['nombre' => 'Ricardo', 'email' => 'ricardo@mail.com']);
        Usuario::create(['nombre' => 'Ana', 'email' => 'ana@mail.com']);

        Pedido::create(['usuario_id' => 1, 'total' => 120]);
        Pedido::create(['usuario_id' => 2, 'total' => 80]);
        Pedido::create(['usuario_id' => 3, 'total' => 200]);
        Pedido::create(['usuario_id' => 4, 'total' => 250]);
        Pedido::create(['usuario_id' => 5, 'total' => 300]);

        return "Registros insertados correctamente.";
    }

    public function pedidosUsuario2()
    {
        return Pedido::where('usuario_id', 2)->get();
    }

    public function pedidosConUsuarios()
    {
        return Pedido::with('usuario')->get();
    }

    public function pedidosEnRango()
    {
        return Pedido::whereBetween('total', [100, 250])->get();
    }

    public function usuariosConR()
    {
        return Usuario::where('nombre', 'LIKE', 'R%')->get();
    }

    public function totalPedidosUsuario5()
    {
        return Pedido::where('usuario_id', 5)->count();
    }

    public function pedidosOrdenados()
    {
        return Pedido::with('usuario')->orderBy('total', 'desc')->get();
    }

    public function sumaTotalPedidos()
    {
        return Pedido::sum('total');
    }

    public function pedidoMasEconomico()
    {
        return Pedido::with('usuario')->orderBy('total', 'asc')->first();
    }

    public function pedidosAgrupados()
{
    return Pedido::select('usuario_id', DB::raw('SUM(total) as total'))
                 ->groupBy('usuario_id')
                 ->with('usuario')
                 ->get();
}

}
