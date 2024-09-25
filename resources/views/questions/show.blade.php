<x-app-layout>
    <div class="bg-yellow my-8 rounded-2xl px-16 py-8">
        <div class="flex justify-end">
            @can("update", $question)
                <form action="/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="button" onclick="deleteConfirmation({{ $question->id }})">
                        <div class="question-delete ml-4 flex items-center">
                            <i class="fa-solid fa-trash-can"></i>
                            <p class="ml-2">削除</p>
                        </div>
                    </button>
                </form>
            @endcan

            @can("update", $question)
                <div class="edit">
                    <a href="/questions/{{ $question->id }}/edit" class="inline-block">
                        <div class="question-edit ml-4 flex items-center">
                            <i class="fa-solid fa-pen"></i>
                            <p class="ml-2">編集</p>
                        </div>
                    </a>
                </div>
            @endcan
        </div>
        <div class="shadow-whole-orange rounded-2xl bg-white p-8">
            <div class="title text-3xl font-bold">
                <h2>{{ $question->title }}</h2>
            </div>
            <div class="body mt-4 text-xl">
                <h2>{{ $question->body }}</h2>
            </div>
            <div class="categories mt-4 flex items-center justify-start text-lg">
                @if ($question->categories->isNotEmpty())
                    <p>カテゴリー：</p>
                    {{ $question->categories->pluck("name")->implode(" ") }}
                @else
                    <p>カテゴリー：なし</p>
                @endif
            </div>
            <div class="images flex flex-wrap items-center justify-around">
                @foreach ($images as $image)
                    <div>
                        <img src="{{ $image->image_url }}" alt="画像が読み込めません。" class="w-100 h-100 object-contain" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="question-info mt-2 flex justify-end">
            @if ($question->status == "未解決")
                <div class="bg-green text-white text-base font-bold flex items-center rounded px-2">
                    <p>{{ $question->status }}</p>
                </div>
            @else
                <div class="bg-pink text-white text-base font-bold flex items-center rounded px-2">
                    <p>{{ $question->status }}</p>
                </div>
            @endif
            <div class="question-author ml-4 flex items-center">
                <i class="fa-regular fa-user"></i>
                <p class="ml-2">{{ $question->user->name }}</p>
            </div>
            <div class="question-like ml-4 flex items-center">
                @auth
                    @if ($question->isLikedByAuthUser())
                        <i class="fa-solid fa-heart like-btn text-orangered duration-200" id="{{ $question->id }}"></i>
                        <p class="ml-2">{{ $question->question_likes->count() }}</p>
                    @else
                        <i class="fa-regular fa-heart like-btn" id="{{ $question->id }}"></i>
                        <p class="ml-2">{{ $question->question_likes->count() }}</p>
                    @endif
                @endauth

                @guest
                    <a href="/login" class="block">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <p class="ml-2">{{ $question->question_likes->count() }}</p>
                @endguest
            </div>
            <div class="question-reply ml-4 flex items-center">
                <i class="fa-regular fa-comment-dots"></i>
                <p class="ml-2">{{ $question->answers->count() }}</p>
            </div>
            <div class="question-create-date ml-4 flex items-center">
                <i class="fa-solid fa-calendar-days"></i>
                <p class="ml-2">{{ $question->created_at->format("Y/m/d") }}</p>
            </div>
        </div>
        <div class="flex items-center justify-around py-4">
            <a href="/questions/{{ $question->id }}/answers/create" class="inline-block">
                <p class="text-orange border border-solid border-orange box-border rounded-lg bg-white px-24 py-4 text-center text-2xl font-bold">返信</p>
            </a>
        </div>

        <div class="answers">
            @foreach ($answers as $answer)
                <div class="mt-8 flex items-end justify-between">
                    <div class="text-5xl text-orange">
                        <i class="fa-solid fa-reply"></i>
                    </div>
                    <div class="flex justify-end">
                        @can("delete", $answer)
                            <form action="/questions/{{ $question->id }}/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="button" onclick="deleteConfirmation({{ $answer->id }})">
                                    <div class="question-delete ml-4 flex items-center">
                                        <i class="fa-solid fa-trash-can"></i>
                                        <p class="ml-2">削除</p>
                                    </div>
                                </button>
                            </form>
                        @endcan

                        @can("update", $answer)
                            <div class="edit">
                                <a href="/questions/{{ $question->id }}/answers/{{ $answer->id }}/edit" class="inline-block">
                                    <div class="question-edit ml-4 flex items-center">
                                        <i class="fa-solid fa-pen"></i>
                                        <p class="ml-2">編集</p>
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="shadow-whole-orange flex flex-col gap-4 rounded-2xl bg-white p-8">
                    @if ($answer->best_answer)
                        <div class="text-orange flex items-center gap-2 text-3xl font-bold">
                            <i class="fa-solid fa-crown"></i>
                            <p>ベストアンサー</p>
                        </div>
                    @endif

                    <h2 class="flex items-center text-xl">{{ $answer->comment }}</h2>
                </div>
                @can("selectBestAnswer", $answer)
                    <form action="/questions/{{ $question->id }}/answers/{{ $answer->id }}/best" method="POST" class="flex items-center justify-end pt-4">
                        @csrf
                        <i class="fa-solid fa-crown text-range text-2xl"></i>
                        <button type="submit" class="text-xl font-bold">ベストアンサーに選ぶ</button>
                    </form>
                @endcan
            @endforeach
        </div>
        <div class="paginate mt-4">
            {{ $answers->links("vendor.pagination.mypagination") }}
        </div>
        <div class="flex items-center justify-around pt-16">
            <a href="/" class="text-orange text-2xl font-bold underline">ホームに戻る</a>
        </div>
    </div>
</x-app-layout>
