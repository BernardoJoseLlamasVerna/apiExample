<?php

namespace Tests\Feature;

use App\Lesson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonsTest extends ApiTester
{
    public function it_fetches_lessons()
    {
        //arrange
        $this->makeLesson();

        //act
        $this->getJson('api/v1/lessons');

        //assert
        $this->assertResponseOk();
    }

    public function it_fetches_a_single_lesson()
    {
        $this->makeLesson();
        $this->getJson('api/v1/lessons/1');

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($lesson, 'body', 'active');

    }

    public function it_404s_if_a_lesson_is_not_found()
    {
        $response = $this->getJson('/api/v1/lessons/x');
        // dd($response);
        $response->assertStatus(404)
            ->assertJsonStructure(['error']);
    }

    private function makeLesson($lessonFields = [])
    {
        $lesson = array_merge([
            'title'     => $this->fake->sentence,
            'body'      => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean

        ], $lessonFields);


        while($this->times --) Lesson::create($lesson);
    }

    private function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }

    }


}
