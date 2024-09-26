<x-app-layout>
    <div class="bg-yellow my-8 flex rounded-2xl">
        <div class="w-1/2">
            <div class="mx-8 my-8 rounded-2xl bg-white p-8">
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
                            <img src="{{ $image->image_url }}" alt="画像が読み込めません。" class="w-50 h-50 object-contain" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="answer-area h-screen-40 w-1/2">
            <form action="/answers" method="POST" class="h-full-16 mx-8 my-8 pb-8">
                @csrf
                <div class="user_id">
                    <input type="hidden" name="answer[user_id]" value="{{ Auth::user()->id }}" />
                </div>
                <div class="question_id">
                    <input type="hidden" name="answer[question_id]" value="{{ $question->id }}" />
                </div>
                <div class="comment h-full-23.5 mb-8">
                    <div class="h-full-6">
                        <textarea name="answer[comment]" placeholder="回答を入力してください" class="h-full w-full rounded-2xl p-8 text-xl">{{ $answer->comment }}</textarea>
                    </div>
                    <p class="comment__error" style="color: red">{{ $errors->first("answer.comment") }}</p>
                </div>

                <div class="flex flex-row-reverse justify-around">
                    <div class="bg-orange rounded-lg px-12 py-4 text-center text-xl font-bold text-white">
                        <input type="submit" value="回答" />
                    </div>
                    <div class="text-orange border border-solid border-orange box-border rounded-lg bg-white px-12 py-4 text-center text-xl font-bold">
                        <a href="/questions/{{ $question->id }}">戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
