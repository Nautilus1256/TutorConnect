<x-app-layout>
    <div class="title">
        <h2>{{ $question->title }}</h2>
    </div>
    <div class="body">
        <p>{{ $question->body }}</h2>
    </div>
    <div class="edit">
        <a href="/questions/{{ $question->id }}/edit" class="underline">編集</a>
    </div>
    <div class='footer'>
        <a href="/" class='underline'>戻る</a>
    </div>
</x-app-layout>