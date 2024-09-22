<x-app-layout>
    <div class='flex'>
        <div class='w-2-10 leftside'>
            <div class='mt-4 mr-4 p-4 rounded-lg bg-white'>
                <form action='/search/word' method='GET' class='flex justify-center border-2 border-gray-400 h-12 mx-auto rounded'>
                    <input type='text' name='keyword' placeholder='キーワードを入力' class='word-search-area px-3 bg-transparent'>
                    <button type='submit' class='w-12 bg-transparent text-gray-600 text-lg cursor-pointer'><i class='fa-solid fa-magnifying-glass'></i></button>
                </form>
                
                <form action='/search/category' method='GET' class='flex flex-col mx-auto w-52 mt-4'>
                    @foreach($category_types as $category_type)
                        <div class='category-type text-xl p-4 text-white rounded-lg font-bold mt-4 text-center mx-4'>
                            @if($category_type->id == 1)
                                <i class="fa-solid fa-book"></i>
                            @elseif($category_type->id == 2)
                                <i class="fa-solid fa-graduation-cap"></i>
                            @elseif($category_type->id == 3)
                                <i class="fa-solid fa-house"></i>
                            @endif
                            {{ $category_type->name }}
                        </div>
                        <div class='ml-5'>
                            @foreach($category_type->categories as $category)
                                <div class='my-4 ml-4'>
                                    <input type='checkbox' name='categories[]' value='{{ $category->id }}'>
                                    <label class='category-color'>
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <button type='submit' class='category-search-btn p-4 mt-4 rounded-lg mx-4'>検索</button>
                </form>
            </div>
        </div>
        
        <div class='w-8-10 rightside'>
            <div class='my-8 ml-8 rounded-2xl right-area'>
                <div class='questions block mx-16 pt-4'>
                    @foreach ($questions as $question)
                        <div class='question flex flex-col py-4'>
                            <a href='/questions/{{ $question->id }}' class='block'>
                                <div class='question-content bg-white flex justify-between rounded-2xl p-8 h-20 max-w-full overflow-hidden box-content'>
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
                                                    {{ $question->categories->pluck('name')->implode(' ') }}
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
                            
                            <div class='question-info mt-2 flex justify-end'>
                                @if($question->status == "未解決")
                                    <div class='question-unresolved rounded px-2 flex items-center'>
                                        <p>{{ $question->status }}</p>
                                    </div>
                                @else
                                    <div class='question-resolved rounded px-2 flex items-center'>
                                        <p>{{ $question->status }}</p>
                                    </div>
                                @endif
                                <div class='question-author flex items-center ml-4'>
                                    <i class='fa-regular fa-user'></i>
                                    <p class='ml-2'>{{ $question->user->name }}</p>
                                </div>
                                <div class='question-like ml-4 flex items-center'>
                                    @auth
                                        @if($question->isLikedByAuthUser())
                                           
                                            <i class="fa-solid fa-heart like-btn liked" id={{$question->id}}></i>
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
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <p class='ml-2'>{{$question->created_at->format('Y/m/d')}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class='paginate'>
                        {{ $questions->links('vendor.pagination.mypagination') }}
                    </div>
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