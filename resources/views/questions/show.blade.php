<x-app-layout>
    <div class="title">
        <h2>{{ $question->title }}</h2>
    </div>
    <div class="body">
        <p>{{ $question->body }}</h2>
    </div>
    <div>
        <a href="/questions/{{ $question->id }}/answers/create" class="underline">回答する</a>
    </div>
    <div class="edit">
        <a href="/questions/{{ $question->id }}/edit" class="underline">編集</a>
    </div>
    <form action="/questions/{{ $question->id }}" id="form_{{ $question->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" onclick="deleteQuestion({{ $question->id }})">削除</button>
    </form>
    <div class="answers">
        @foreach ($answers as $answer)
            <div class="answer">
                <p>{{ $answer->comment }}</p>
            </div>
            <div class="edit">
                <a href="/questions/{{ $question->id }}/answers/{{ $answer->id }}/edit" class="underline">編集</a>
            </div>
            <form action="/questions/{{ $question->id }}/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteAnswer({{ $answer->id }})">削除</button>
            </form>
        @endforeach
    </div>
    <div class='paginate underline'>
        {{ $answers->links() }}
    </div>
    <div class='footer'>
        <a href="/" class='underline'>戻る</a>
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
</x-app-layout>