<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();

        return response()->json([
            'data'=>$this->transformCollection($lessons)
        ], 200);
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

    private function transformCollection($lessons)
    {
        return array_map([$this, 'transform'], $lessons->toArray());
    }

    private function transform($lesson)
    {
        return [
            'title'  => $lesson['title'],
            'body'   => $lesson['body'],
            'active' => (boolean) $lesson['some_bool']
        ];

    }

}
