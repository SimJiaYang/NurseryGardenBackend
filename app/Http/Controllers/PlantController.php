<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**Plant List */
    public function index()
    {
        return view('plant.plant');
    }
}
