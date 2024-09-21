<x-app-layout>
    <div class='flex'>
        <div class='w-2-10 border-r border-black leftside-color'>
            <form action='/search/word' method='GET' class='flex justify-center border-2 border-gray-600 h-12 mx-auto rounded w-52 mt-10'>
                <input type='text' name='keyword' placeholder='キーワードを入力' class='word-search-area w-40 px-3 bg-transparent'>
                <button type='submit' class='w-12 bg-transparent text-gray-600 text-lg cursor-pointer'><i class='fa-solid fa-magnifying-glass'></i></button>
            </form>
            
            <form action='/search/category' method='GET' class='flex flex-col mx-auto w-52 mt-10'>
                @foreach($category_types as $category_type)
                    <div class='text-xl'>{{ $category_type->name }}</div>
                    <div class='ml-5'>
                        @foreach($category_type->categories as $category)
                            <div>
                                <input type='checkbox' name='categories[]' value='{{ $category->id }}'>
                                <label>
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type='submit'>検索</button>
            </form>

        </div>
        <div class='w-8-10 bg-white'>
            <div class='questions block mx-28 mt-20'>
                @foreach ($questions as $question)
                    <div class='question flex flex-col py-4'>
                        <a href='/questions/{{ $question->id }}' class='block'>
                            <div class='question-content flex justify-between border-2 rounded-2xl border-black p-4 h-20 max-w-full overflow-hidden box-content'>
                                @if($question->images->isNotEmpty())
                                    <div class='question-letters-with-image'>
                                        <h2 class='question-title text-2xl font-bold truncate'>
                                            {{ $question->title }}
                                        </h2>
                                        <p class='question-body truncate'>
                                            {{ $question->body }}
                                        </p>
                                        <div class='question-category flex items-center justify-start text-xs mt-2'>
                                            @if($question->categories->isNotEmpty())
                                                <p>カテゴリー：</p>
                                                @foreach ($question->categories as $category)
                                                    <p>{{ $category->name }}</p>
                                                @endforeach
                                            @else
                                                <p>カテゴリー：なし</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class='question-image'>
                                        <img src='{{ $question->images->first()->image_url }}' alt='画像' class='block box-border w-20 h-20 ml-5 border rounded-lg border-gray-400'>
                                    </div>
                                @else
                                    <div class='question-letters-without-image'>
                                        <h2 class='question-title text-2xl font-bold truncate'>
                                            {{ $question->title }}
                                        </h2>
                                        <p class='question-body truncate'>
                                            {{ $question->body }}
                                        </p>
                                        <div class='question-category flex items-center justify-start text-xs mt-2'>
                                            @if($question->categories->isNotEmpty())
                                                <p>カテゴリー：</p>
                                                @foreach ($question->categories as $category)
                                                    <p>{{ $category->name }}</p>
                                                @endforeach
                                            @else
                                                <p>カテゴリー：なし</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </a>
                        
                        <div class='question-info flex justify-end'>
                            <div class='question-status flex items-center'>
                                <p>{{ $question->status }}</p>
                            </div>
                            <div class='question-author flex items-center ml-4'>
                                <i class='fa-regular fa-user'></i>
                                <p class='ml-2'>{{ $question->user->name }}</p>
                            </div>
                            <div class='question-like ml-4 flex items-center'>
                                @auth
                                    @if($question->isLikedByAuthUser())
                                        <i class='fa-regular fa-heart like-btn liked' id={{$question->id}}></i>
                                        <p class='ml-2'>{{$question->question_likes->count()}}</p>
                                    @else
                                        <i class='fa-regular fa-heart like-btn' id={{$question->id}}></i>
                                        <p class='ml-2'>{{$question->question_likes->count()}}</p>
                                    @endif
                                @endauth
                                @guest
                                    <a href='/login' class='block'>
                                        <i class='fa-regular fa-heart'></i>
                                    </a>
                                    <p class='ml-2'>{{$question->question_likes->count()}}</p>
                                @endguest
                            </div>
                            <div class='question-reply ml-4 flex items-center'>
                                <i class="fa-regular fa-comment-dots"></i>
                                <p class='ml-2'>{{$question->answers->count()}}</p>
                            </div>
                            <div class='question-create-date ml-4 flex items-center'>
                                <i class="fa-solid fa-pen"></i>
                                <p class='ml-2'>{{$question->created_at->format('Y/m/d')}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class='paginate'>
                    {{ $questions->links('vendor.pagination.mypagination') }}
                </div>
            </div>
            <div class='post-btn'>
                <a href='/questions/create'>
                    <i class='fa-regular fa-pen-to-square post-icon'></i>
                </a>
            </div>
        </div>
    </div>
    
    
</x-app-layout>