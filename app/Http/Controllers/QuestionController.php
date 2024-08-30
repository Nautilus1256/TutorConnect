<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index(Question $question)
    {
        return view('questions.index')->with(['questions' => $question->getPaginateByLimit()]);
    }
    
    public function show(Question $question, Answer $answer)
    {
        return view('questions.show')->with(['question' => $question, 'answers' => $question->answers()->getPaginateByLimit()]);
    }
    
    public function create()
    {
        return view('questions.create');
    }
    
    public function store(QuestionRequest $request, Question $question)
    {
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/questions/' . $question->id);
    }
    
    public function edit(Question $question)
    {
        return view('questions/edit')->with(['question' => $question]);
    }
    
    public function update(QuestionRequest $request, Question $question)
    {
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/questions/' . $question->id);
    }
    
    public function delete(Question $question)
    {
        $question->delete();
        return redirect('/');
    }
}
