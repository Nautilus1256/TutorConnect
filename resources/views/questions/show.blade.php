<x-app-layout>
    <div class='my-8 rounded-2xl px-16 py-8 question-show-area'>
        <div class='flex justify-end'>
            @can('update', $question)
                <form action="/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteQuestion({{ $question->id }})">
                        <div class='question-delete flex items-center ml-4'>
                            <i class='fa-solid fa-trash-can'></i>
                            <p class='ml-2'>削除</p>
                        </div>
                    </button>
                </form>
            @endcan
            @can('update', $question)
                <div class="edit">
                    <a href="/questions/{{ $question->id }}/edit" class="inline-block">
                        <div class='question-edit flex items-center ml-4'>
                            <i class='fa-solid fa-pen'></i>
                            <p class='ml-2'>編集</p>
                        </div>
                    </a>
                </div>
            @endcan
            
        </div>
        <div class='rounded-2xl bg-white p-8 question-content'>
            <div class="title text-3xl font-bold">
                <h2>{{ $question->title }}</h2>
            </div>
            <div class="body mt-4 text-xl">
                <h2>{{ $question->body }}</h2>
            </div>
            <div class="categories flex items-center justify-start mt-4 text-lg">
                @if($question->categories->isNotEmpty())
                    <p>カテゴリー：</p>
                    {{ $question->categories->pluck('name')->implode(' ') }}
                @else
                    <p>カテゴリー：なし</p>
                @endif
            </div>
            <div class='images flex items-center justify-around flex-wrap'>
                @foreach ($images as $image)
                    <div>
                        <img src="{{ $image->image_url }}" alt="画像が読み込めません。" class='object-contain question-show-image'>
                    </div>
                @endforeach
            </div>
        </div>
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

        <div class="answers">
            @foreach ($answers as $answer)
                <div class='flex justify-between items-end mt-8'>
                    <div class='reply-icon'>
                        <i class="fa-solid fa-reply"></i>
                    </div>
                    <div class='flex justify-end'>
                        @can('delete', $answer)
                            <form action="/questions/{{ $question->id }}/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteAnswer({{ $answer->id }})">
                                    <div class='question-delete flex items-center ml-4'>
                                        <i class='fa-solid fa-trash-can'></i>
                                        <p class='ml-2'>削除</p>
                                    </div>
                                </button>
                            </form>
                        @endcan
                        @can('update', $answer)
                            <div class="edit">
                                <a href="/questions/{{ $question->id }}/answers/{{ $answer->id }}/edit" class="inline-block">
                                    <div class='question-edit flex items-center ml-4'>
                                        <i class='fa-solid fa-pen'></i>
                                        <p class='ml-2'>編集</p>
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class='answer-content rounded-2xl bg-white p-8 text-xl flex items-center'>
                    <h2>{{ $answer->comment }}</h2>
                </div>
            @endforeach
        </div>
        <div class='paginate underline'>
            {{ $answers->links() }}
        </div>
        <div class='footer'>
            <a href="/" class='underline'>戻る</a>
        </div>
        
        <div class='post-btn'>
            <a href="/questions/{{ $question->id }}/answers/create" class="underline">
                <!--<i class="fa-solid fa-comment-dots post-icon"></i>-->
                <!--<i class="fa-regular fa-message post-icon"></i>-->
                <!--<i class="fa-solid fa-message post-icon"></i>-->
                <i class="fa-solid fa-reply post-icon"></i>
            </a>
        </div>
        
        <script>
            function deleteQuestion(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            function deleteAnswer(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </div>
</x-app-layout>