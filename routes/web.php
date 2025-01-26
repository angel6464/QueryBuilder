<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

Route::get('/insertar', [PedidoController::class, 'insertarRegistros']);
Route::get('/pedidos_usuario_2', [PedidoController::class, 'pedidosUsuario2']);
Route::get('/pedidos_con_usuarios', [PedidoController::class, 'pedidosConUsuarios']);
Route::get('/pedidos_en_rango', [PedidoController::class, 'pedidosEnRango']);
Route::get('/usuarios_con_r', [PedidoController::class, 'usuariosConR']);
Route::get('/total_pedidos_usuario_5', [PedidoController::class, 'totalPedidosUsuario5']);
Route::get('/pedidos_ordenados', [PedidoController::class, 'pedidosOrdenados']);
Route::get('/suma_total_pedidos', [PedidoController::class, 'sumaTotalPedidos']);
Route::get('/pedido_mas_economico', [PedidoController::class, 'pedidoMasEconomico']);
Route::get('/pedidos_agrupados', [PedidoController::class, 'pedidosAgrupados']);
