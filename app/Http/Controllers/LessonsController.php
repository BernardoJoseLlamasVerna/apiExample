<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();

        return response()->json(['data'=>$lessons->toArray()], 200);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(!$lesson)
        {
            return response()->json(['error'=>
                ['message'=>'Lesson does not exist']
            ],
                404);

        }

        return response()->json(['data'=>$lesson->toArray()], 200);

    }

}
