<x-app-layout>
    <div class='flex my-8 rounded-2xl answer-create-background'>
        <div class='w-1/2'>
            <div class='rounded-2xl p-8 my-8 mx-8 bg-white'>
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
                            <img src="{{ $image->image_url }}" alt="画像が読み込めません。" class='object-contain answer-create-image'>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class='w-1/2 answer-area h-full-minus-160px'>
            <form action="/answers" method="POST" class='my-8 mx-8 h-full-minus-64px pb-8'>
                @csrf
                <div class="user_id">
                    <input type="hidden" name="answer[user_id]" value="{{ Auth::user()->id }}"/>
                </div>
                <div class="question_id">
                    <input type="hidden" name="answer[question_id]" value="{{ $question->id }}"/>
                </div>
                <div class="comment mb-8 h-full-minus-94px">
                    <div class='h-full-minus-24px'>
                        <textarea name="answer[comment]" placeholder="回答を入力してください" class='w-full h-full rounded-2xl p-8 text-xl'>{{ old('answer.comment') }}</textarea>
                    </div>
                    <p class="comment__error" style="color:red">{{ $errors->first('answer.comment') }}</p>
                </div>
                
                <div class='flex justify-around flex-row-reverse'>
                    <div class='text-xl px-12 py-4 text-white rounded-lg font-bold text-center answer-btn'>
                        <input type="submit" value="回答"/>
                    </div>
                    <div class='text-xl px-12 py-4 bg-white rounded-lg font-bold text-center box-border answer-create-return-btn'>
                        <a href="/questions/{{ $question->id }}">戻る</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>