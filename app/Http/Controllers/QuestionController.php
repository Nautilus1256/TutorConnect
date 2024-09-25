<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Answer;
use Cloudinary;

class QuestionController extends Controller
{
    public function index(Question $question)
    {
        $categoryTypes = CategoryType::with('categories')->get();
        return view('questions.index')->with(['questions' => $question->getPaginateByLimit(), 'category_types' => $categoryTypes]);
    }
    
    public function show(Question $question, Answer $answer)
    {
        return view('questions.show')->with(['question' => $question, 'answers' => $question->answers()->getPaginateByLimit(), 'images' => $question->images()->get()]);
    }
    
    public function create()
    {
        $categoryTypes = CategoryType::with('categories')->get();
        return view('questions.create')->with(['category_types' => $categoryTypes]);
    }
    
    public function store(QuestionRequest $request, Question $question)
    {
        $input_question = $request['question'];
        $input_categories = $request->categories;
        $question->fill($input_question)->save();
        $question->categories()->attach($input_categories);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $question->images()->create([
                    'image_url' => $image_url,
                ]);
            }
        }
        return redirect('/questions/' . $question->id);
    }
    
    public function edit(Question $question)
    {
        $this->authorize('update', $question);
        $categories = Category::all();
        $selected_categories = $question->categories->pluck('id')->toArray();
        return view('questions.edit')->with(['question' => $question, 'categories' => $categories, 'selected_categories' => $selected_categories]);
    }
    
    public function update(QuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);
        $input_question = $request['question'];
        $input_categories = $request->categories_array;
        $question->fill($input_question)->save();
        $question->categories()->sync($input_categories);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $question->images()->create([
                    'image_url' => $image_url,
                ]);
            }
        }
        return redirect('/questions/' . $question->id);
    }
    
    public function delete(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
        return redirect('/');
    }
    
    public function wordSearch(Request $request, Question $question)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $questions = $question->where('title', 'LIKE', "%{$keyword}%")->orWhere('body', 'LIKE', "%{$keyword}%")->getPaginateByLimit()->appends(['keyword' => $keyword]);
            return view('questions.word-search')->with(['questions' => $questions, 'keyword' => $keyword]);
        } else {
            return redirect('/');
        }
    }
    
    public function categorySearch(Request $request, Question $question)
    {
        if ($request->has('categories')) {
            $categories = $request->input('categories');
            $selectedCategoryNames = Category::whereIn('id', $categories);
            $questions = $question->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('categories.id', $categories);
            });
            $questions = $questions->getPaginateByLimit()->appends(['categories' => $categories]);
            return view('questions.category-search')->with(['questions' => $questions, 'selectedCategoryNames' => $selectedCategoryNames]);
        }
        else {
            return redirect('/');
        }
    }
}