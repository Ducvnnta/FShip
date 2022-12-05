<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

trait ApiResponser {

  protected function successResponse($data = [], $message = null, $statusCode = 200)
	{
		$statusMaintenace = getStatusMaintenance();
		return response()->json([
			'status'=> $statusCode,
			'message' => $message,
			'data' => $data,
			'maintenace' => $statusMaintenace
		], $statusCode);
	}

	protected function errorResponse($message = null, $statusCode = 422, $data = [])
	{
		$statusMaintenace = getStatusMaintenance();
		return response()->json([
			'status'=> $statusCode,
			'message' => $message,
			'data' => $data,
			'maintenace' => $statusMaintenace
		], $statusCode);
	}
}
