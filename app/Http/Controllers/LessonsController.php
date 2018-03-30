<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\LessonTransformer;


class LessonsController extends ApiController
{
    protected $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function index()
    {
        $lessons = Lesson::all();

        return $this->respond([
            'data'=>$this->lessonTransformer->transformCollection($lessons->all())
        ]);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(!$lesson)
        {
            return $this->respondNotFound('Lesson does not exist');
        }

        return $this->respond(
            ['data'=>$this->lessonTransformer->transform($lesson)]
        );
    }

}
