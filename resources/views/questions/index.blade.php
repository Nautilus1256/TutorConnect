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
                <h2 class='title'>{{ $question->title }}</h2>
            </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $questions->links() }}
    </div>
</x-app-layout>