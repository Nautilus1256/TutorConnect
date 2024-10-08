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
        return view('answers.create')->with(['question' => $question, 'images' => $question->images()->get()]);
    }
    
    public function store(AnswerRequest $request, Answer $answer)
    {
        $input = $request['answer'];
        $answer->fill($input)->save();
        return redirect('/questions/' . $answer->question_id);
    }
    
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit')->with(['question' => $question, 'images' => $question->images()->get(), 'answer' => $answer]);
    }
    
    public function update(AnswerRequest $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $input = $request['answer'];
        $answer->fill($input)->save();
        return redirect('/questions/' . $answer->question_id);
    }
    
    public function delete(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();
        return redirect('/questions/' . $answer->question_id);
    }
    
    public function selectBestAnswer(Question $question, Answer $answer)
    {
        $this->authorize('selectBestAnswer', $answer);
        $answer->best_answer = true;
        $answer->save();
        $answer->question->status = '解決済み';
        $answer->question->save();
        return redirect('/questions/' . $answer->question_id);
    }
}
