<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Transformers\LessonTransformer;
use Illuminate\Support\Facades\Input;


class LessonsController extends ApiController
{
    protected $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;

        //auth only for store method:
        $this->middleware('auth.basic', ['only' => 'store']);
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

    public function store(Request $request)
    {
        if(!$request->title or !$request->body)
        {
            //return some kind of response, set a statusCode and provide a message:
            return $this->setStatusCode(422)
                        ->respondWithError('Parameters failed validation for a lesson');
        }

        //Lesson::create(Input::all());

        return $this->respondCreated('Lesson succesfully created.');
    }

}
