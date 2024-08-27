<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

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
    
    public function store(Request $request, Question $question)
    {
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect('/questions/' . $question->id);
    }
}
