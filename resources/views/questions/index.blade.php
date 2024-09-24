<x-app-layout>
    <div class="flex">
        <div class="basis-1/5 bg-white">
            <div class="mr-4 mt-4 rounded-lg bg-white p-4">
                <form action="/search/word" method="GET" class="mx-auto flex h-12 justify-center rounded border-2 border-gray-400">
                    <input type="text" name="keyword" placeholder="キーワードを入力" class="border-none w-full-12 bg-transparent px-3" />
                    <button type="submit" class="w-12 cursor-pointer bg-transparent text-lg text-gray-600"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <form action="/search/category" method="GET" class="mx-auto mt-4 flex w-52 flex-col">
                    @foreach ($category_types as $category_type)
                        <div class="bg-orange mx-4 mt-4 rounded-lg p-4 text-center text-xl font-bold text-white">
                            @if ($category_type->name == "教科")
                                <i class="fa-solid fa-book"></i>
                            @elseif ($category_type->name == "学年")
                                <i class="fa-solid fa-graduation-cap"></i>
                            @elseif ($category_type->name == "環境")
                                <i class="fa-solid fa-house"></i>
                            @endif
                            {{ $category_type->name }}
                        </div>
                        <div class="ml-5">
                            @foreach ($category_type->categories as $category)
                                <div class="my-4 ml-4">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" />
                                    <label class="text-zinc-500">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <button type="submit" class="category-search-btn border-4 border-solid border-orange text-orange text-2xl font-bold shadow-whole-lightgray mx-4 mt-4 rounded-lg p-4">検索</button>
                </form>
            </div>
        </div>

        <div class="basis-4/5 max-w-4/5 rightside">
            <div class="bg-yellow my-8 ml-8 rounded-2xl">
                <div class="questions mx-16 block pt-4">
                    @foreach ($questions as $question)
                        <div class="question flex flex-col py-4">
                            <a href="/questions/{{ $question->id }}" class="block">
                                <div class="shadow-whole-orange box-content flex h-20 max-w-full justify-between overflow-hidden rounded-2xl bg-white p-8">
                                    @if ($question->images->isNotEmpty())
                                        <div class="w-full-25">
                                            <h2 class="question-title truncate text-2xl font-bold">
                                                {{ $question->title }}
                                            </h2>
                                            <p class="text-zinc-500 truncate">
                                                {{ $question->body }}
                                            </p>
                                            <div class="question-category mt-2 flex items-center justify-start text-xs">
                                                @if ($question->categories->isNotEmpty())
                                                    <p>カテゴリー：</p>
                                                    {{ $question->categories->pluck("name")->implode(" ") }}
                                                @else
                                                    <p>カテゴリー：なし</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="question-image">
                                            <img src="{{ $question->images->first()->image_url }}" alt="画像" class="ml-5 box-border block h-20 w-20 rounded-lg border border-gray-400" />
                                        </div>
                                    @else
                                        <div class="w-full">
                                            <h2 class="question-title truncate text-2xl font-bold">
                                                {{ $question->title }}
                                            </h2>
                                            <p class="text-zinc-500 truncate">
                                                {{ $question->body }}
                                            </p>
                                            <div class="question-category mt-2 flex items-center justify-start text-xs">
                                                @if ($question->categories->isNotEmpty())
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

                            <div class="question-info mt-2 flex justify-end">
                                @if ($question->status == "未解決")
                                    <div class="bg-green text-base text-white font-bold flex items-center rounded px-2">
                                        <p>{{ $question->status }}</p>
                                    </div>
                                @else
                                    <div class="bg-pink text-base text-white font-bold flex items-center rounded px-2">
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
                        </div>
                    @endforeach

                    <div class="paginate">
                        {{ $questions->links("vendor.pagination.mypagination") }}
                    </div>
                </div>
            </div>
            <div class="fixed bottom-7.5 right-7.5 w-30 h-30 rounded-full bg-orange cursor-pointer z-10">
                <a href="/questions/create" class="inline-flex h-full w-full items-center justify-center gap-1 text-3xl font-bold text-white">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>投稿</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
