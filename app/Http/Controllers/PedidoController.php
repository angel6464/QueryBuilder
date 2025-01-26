<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Aquí importamos DB para hacer consultas avanzadas

class PedidoController extends Controller
{
    /**
     * Aquí insertamos registros en las tablas "usuarios" y "pedidos".
     */
    public function insertarRegistros()
    {
        // Primero, creamos algunos usuarios en la base de datos.
        Usuario::create(['nombre' => 'Roberto', 'email' => 'roberto@mail.com']);
        Usuario::create(['nombre' => 'Carlos', 'email' => 'carlos@mail.com']);
        Usuario::create(['nombre' => 'Rosa', 'email' => 'rosa@mail.com']);
        Usuario::create(['nombre' => 'Ricardo', 'email' => 'ricardo@mail.com']);
        Usuario::create(['nombre' => 'Ana', 'email' => 'ana@mail.com']);

        // Luego, les asignamos pedidos con diferentes totales.
        Pedido::create(['usuario_id' => 1, 'total' => 120]);
        Pedido::create(['usuario_id' => 2, 'total' => 80]);
        Pedido::create(['usuario_id' => 3, 'total' => 200]);
        Pedido::create(['usuario_id' => 4, 'total' => 250]);
        Pedido::create(['usuario_id' => 5, 'total' => 300]);

        // Devolvemos un mensaje para saber que todo salió bien.
        return "Registros insertados correctamente.";
    }

    /**
     * Este método sirve para obtener todos los pedidos del usuario con ID 2.
     */
    public function pedidosUsuario2()
    {
        return Pedido::where('usuario_id', 2)->get(); // Filtramos solo los pedidos de ese usuario
    }

    /**
     * Aquí obtenemos todos los pedidos, pero también incluimos la información del usuario que los hizo.
     */
    public function pedidosConUsuarios()
    {
        return Pedido::with('usuario')->get(); // Usamos 'with' para traer los datos del usuario en la misma consulta
    }

    /**
     * Este método recupera todos los pedidos cuyo total esté entre $100 y $250.
     */
    public function pedidosEnRango()
    {
        return Pedido::whereBetween('total', [100, 250])->get(); // Filtramos pedidos dentro del rango
    }

    /**
     * Aquí buscamos a todos los usuarios cuyos nombres comienzan con la letra "R".
     */
    public function usuariosConR()
    {
        return Usuario::where('nombre', 'LIKE', 'R%')->get(); // Buscamos los nombres que empiezan con "R"
    }

    /**
     * Este método nos dice cuántos pedidos tiene el usuario con ID 5.
     */
    public function totalPedidosUsuario5()
    {
        return Pedido::where('usuario_id', 5)->count(); // Contamos los registros que coincidan
    }

    /**
     * Aquí traemos todos los pedidos junto con los usuarios,
     * pero ordenamos los resultados de mayor a menor según el total del pedido.
     */
    public function pedidosOrdenados()
    {
        return Pedido::with('usuario')->orderBy('total', 'desc')->get();
    }

    /**
     * Este método obtiene la suma total de todos los pedidos.
     */
    public function sumaTotalPedidos()
    {
        return Pedido::sum('total'); // Sumamos el total de todos los pedidos
    }

    /**
     * Aquí buscamos el pedido más barato junto con el nombre del usuario que lo hizo.
     */
    public function pedidoMasEconomico()
    {
        return Pedido::with('usuario')->orderBy('total', 'asc')->first(); // Ordenamos de menor a mayor y tomamos el primero
    }

    /**
     * Este método agrupa los pedidos por usuario y nos muestra el total que cada uno ha gastado.
     */
    public function pedidosAgrupados()
    {
        return Pedido::select('usuario_id', DB::raw('SUM(total) as total')) // Sumamos el total gastado por usuario
                     ->groupBy('usuario_id') // Agrupamos por usuario
                     ->with('usuario') // También traemos la información del usuario
                     ->get();
    }
}
