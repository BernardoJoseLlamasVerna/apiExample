<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index()
    {
        return Lesson::all();
    }
}
