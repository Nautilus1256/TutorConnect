<x-app-layout>
    <div class='flex'>
        <div class='w-2-10 border-r border-black'>
            <p>左30%</p>
            <form action='/search/word' method='GET'>
                <input type='text' name='keyword' placeholder='キーワードを入力'>
                <button type='submit'>検索</button>
            </form>
        </div>
        <div class='w-8-10'>
            <div class='questions block mx-28 mt-20'>
                <h2>{{ $keyword }}の検索結果</h2>
                @if($questions->isEmpty())
                    <p>該当する質問が見つかりませんでした。</p>
                @else
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
                @endif
            </div>
            <div class='post-btn'>
                <a href='/questions/create'>
                    <i class='fa-regular fa-pen-to-square post-icon'></i>
                </a>
            </div>
        </div>
    </div>
    
    
</x-app-layout>