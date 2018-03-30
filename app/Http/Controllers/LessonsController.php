<?php

namespace App\Http\Controllers;

use App\Http\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    protected $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function index()
    {
        $lessons = Lesson::all();

        return response()->json([
            'data'=>$this->lessonTransformer->transformCollection($lessons->all())
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

        return response()->json(
            ['data'=>$this->lessonTransformer->transform($lesson)], 200
        );
    }

}
