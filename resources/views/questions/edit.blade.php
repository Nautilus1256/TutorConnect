<x-app-layout>
    <h1>編集画面</h1>
    <form action="/questions/{{ $question->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="user_name">
            <input type="hidden" name="question[user_id]" value="{{ Auth::user()->id }}"/>
        </div>
        <div class="title">
            <h2>質問タイトル</h2>
            <input type="text" name="question[title]" placeholder="タイトル" value="{{ $question->title }}"/>
            <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
        </div>
        <div class="body">
            <h2>質問内容詳細</h2>
            <textarea name="question[body]" placeholder="質問内容詳細">{{ $question->body }}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
        </div>
        <input type="submit" value="保存"/>
        <div class="footer">
            <a href="/questions/{{ $question->id }}" class="underline">戻る</a>
        </div>
    </form>
</x-app-layout>