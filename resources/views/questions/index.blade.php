<x-app-layout>
    <x-slot name="header">
        index
    </x-slot>
    <h1>Tutor Connect</h1>
    <div class='questions'>
        @foreach ($questions as $question)
            <div class='question'>
                <h2 class='title'>{{ $question->title }}</h2>
            </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $questions->links() }}
    </div>
</x-app-layout>