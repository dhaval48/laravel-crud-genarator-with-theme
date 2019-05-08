<?php

namespace App\Http\Controllers\Backend;

use Ongoingcloud\Laravelcrud\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends Controller
{	

	public function getStatus(Request $request) {

		return \DB::table('status')->latest()->wherenull('deleted_at')->pluck('id','name');

	}

	// [Function]
}