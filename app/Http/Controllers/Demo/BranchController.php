<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
  public function list_all()
  {
  	$rpta = '';
	  $status = 200;
	  try {
	    $rs = \Model::factory('\App\Models\Demo\Branch', 'competition')
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
  }
}
