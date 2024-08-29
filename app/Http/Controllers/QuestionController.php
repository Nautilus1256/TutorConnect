<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function index(Question $question)
    {
        return view('questions.index')->with(['questions' => $question->getPaginateByLimit()]);
    }
    
    public function show(Question $question)
    {
        return view('questions.show')->with(['question' => $question]);
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
}
