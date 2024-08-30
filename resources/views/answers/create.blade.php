<x-app-layout>
    <div class="question_title">
        <h2>{{ $question->title }}</h2>
    </div>
    <div class="question_body">
        <p>{{ $question->body }}</h2>
    </div>
    <form action="/answers" method="POST">
        @csrf
        <div class="user_id">
            <input type="hidden" name="answer[user_id]" value="{{ Auth::user()->id }}"/>
        </div>
        <div class="question_id">
            <input type="hidden" name="answer[question_id]" value="{{ $question->id }}"/>
        </div>
        <div class="comment">
            <h2>あなたの回答</h2>
            <textarea name="answer[comment]" placeholder="回答を入力してください">{{ old('answer.comment') }}</textarea>
            <p class="comment__error" style="color:red">{{ $errors->first('answer.comment') }}</p>
        </div>
        <input type="submit" value="回答する"/>
    </form>
    <div class='footer'>
        <a href="/questions/{{ $question->id }}" class="underline">戻る</a>
    </div>
</x-app-layout>