<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Row;

class RowsController extends Controller
{
    public function index()
    {
        $rows = Row::orderBy('id', 'ASC')->get()->groupBy(function ($row) {
            return $row->date;
        })->toArray();

        return view('rows', [
            'rows' => $rows
        ]);
    }
}
