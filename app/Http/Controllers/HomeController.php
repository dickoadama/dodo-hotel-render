<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Reservation;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}