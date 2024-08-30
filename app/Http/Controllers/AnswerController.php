<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    public function create(Question $question)
    {
        return view('answers.create')->with(['question' => $question]);
    }
    
    public function store(AnswerRequest $request, Answer $answer)
    {
        $input = $request['answer'];
        $answer->fill($input)->save();
        return redirect('/questions/' . $answer->question_id);
    }
}
