<x-app-layout>
    <h1>Tutor Connect</h1>
    <form action="/questions" method="POST">
        @csrf
        <div class="user_name">
            <input type="hidden" name="question[user_id]" value="{{ Auth::user()->id }}"/>
        </div>
        <div class="title">
            <h2>質問タイトル</h2>
            <input type="text" name="question[title]" placeholder="タイトル"/>
        </div>
        <div class="body">
            <h2>質問内容詳細</h2>
            <textarea name="question[body]" placeholder="質問内容詳細"></textarea>
        </div>
        <input type="submit" value="store"/>
        <div class="footer">
            <a href="/" class="underline">戻る</a>
        </div>
    </form>
</x-app-layout>