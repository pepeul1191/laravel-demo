<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Branch;

Route::get('/', function () {
    return view('welcome');
});

Route::get('foo', function () {
    return 'Hello World';
});

Route::get('branch/list', function () {
  $rpta = '';
  $status = 200;
  try {
    $rs = \Model::factory('\App\Models\Branch', 'competition')
      ->order_by_asc('id')
      ->find_array();
    $rpta = json_encode($rs);
  }catch (\Exception $e) {
    $status = 500;
    $rpta = json_encode(
      [
        'tipo_mensaje' => 'error',
        'mensaje' => [
          'No se ha podido listar las sedes',
          $e->getMessage()
        ]
      ]
    );
  }
  return response($rpta, $status)
    ->header('Content-Type', 'text/plain');
});