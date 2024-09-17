<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index') }}
        </h2>
    </x-slot>
    <h1>Tutor Connect</h1>
    <div class='questions'>
        @foreach ($questions as $question)
            <div class='question'>
                <h2 class='title'>
                    <a href="/questions/{{ $question->id }}" class="underline">{{ $question->title }}</a>
                </h2>
                
                @auth
                    @if($question->isLikedByAuthUser())
                        <div class="flexbox">
                            <i class="fa-regular fa-heart like-btn liked" id={{$question->id}}></i>
                            <p class="count-num">{{$question->question_likes->count()}}</p>
                        </div>
                    @else
                        <div class="flexbox">
                            <i class="fa-regular fa-heart like-btn" id={{$question->id}}></i>
                            <p class="count-num">{{$question->question_likes->count()}}</p>
                        </div>
                    @endif
                @endauth
                
                @guest
                    <p>loginしていません</p>
                @endguest
                
            </div>
        @endforeach
    </div>
    <div>
        <a href="/questions/create" class="underline">質問を新規作成</a>
    </div>
    <div class='paginate underline'>
        {{ $questions->links() }}
    </div>
    
</x-app-layout>