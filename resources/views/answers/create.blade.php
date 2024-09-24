<x-app-layout>
    <div class="answer-create-background my-8 flex rounded-2xl">
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
                            <img src="{{ $image->image_url }}" alt="画像が読み込めません。" class="answer-create-image object-contain" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="answer-area h-full-minus-160px w-1/2">
            <form action="/answers" method="POST" class="h-full-minus-64px mx-8 my-8 pb-8">
                @csrf
                <div class="user_id">
                    <input type="hidden" name="answer[user_id]" value="{{ Auth::user()->id }}" />
                </div>
                <div class="question_id">
                    <input type="hidden" name="answer[question_id]" value="{{ $question->id }}" />
                </div>
                <div class="comment h-full-minus-94px mb-8">
                    <div class="h-full-minus-24px">
                        <textarea name="answer[comment]" placeholder="回答を入力してください" class="h-full w-full rounded-2xl p-8 text-xl">{{ old("answer.comment") }}</textarea>
                    </div>
                    <p class="comment__error" style="color: red">{{ $errors->first("answer.comment") }}</p>
                </div>

                <div class="flex flex-row-reverse justify-around">
                    <div class="answer-btn rounded-lg px-12 py-4 text-center text-xl font-bold text-white">
                        <input type="submit" value="回答" />
                    </div>
                    <div class="answer-create-return-btn box-border rounded-lg bg-white px-12 py-4 text-center text-xl font-bold">
                        <a href="/questions/{{ $question->id }}">戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
