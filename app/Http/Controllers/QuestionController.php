<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Category;
use App\Models\Answer;
use Cloudinary;

class QuestionController extends Controller
{
    public function index(Question $question)
    {
        return view('questions.index')->with(['questions' => $question->getPaginateByLimit()]);
    }
    
    public function show(Question $question, Answer $answer)
    {
        return view('questions.show')->with(['question' => $question, 'answers' => $question->answers()->getPaginateByLimit(), 'images' => $question->images()->get()]);
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('questions.create')->with(['categories' => $categories]);
    }
    
    public function store(QuestionRequest $request, Question $question)
    {
        $image_urls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $image_urls[] = $image_url;
            }
        }

        $input_question = $request['question'];
        $input_categories = $request->categories_array;
        $question->fill($input_question)->save();
        foreach ($image_urls as $url) {
            $question->images()->create([
                'image_url' => $url,
            ]);
        }
        $question->categories()->attach($input_categories);
        return redirect('/questions/' . $question->id);
    }
    
    public function edit(Question $question)
    {
        $categories = Category::all();
        $selected_categories = $question->categories->pluck('id')->toArray();
        return view('questions/edit')->with(['question' => $question, 'categories' => $categories, 'selected_categories' => $selected_categories]);
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
