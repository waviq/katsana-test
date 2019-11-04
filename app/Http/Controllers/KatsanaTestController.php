<?php

namespace App\Http\Controllers;

use App\Exports\TripExport;
use App\Position;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KatsanaTestController extends Controller
{
    public function index() {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));
    }

    public function create(Request $request) {
        return Excel::download(new TripExport(), 'trip_position.xls');
    }
}
