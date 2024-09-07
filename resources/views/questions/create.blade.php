<x-app-layout>
    <h1>Tutor Connect</h1>
    <form action="/questions" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="user_id">
            <input type="hidden" name="question[user_id]" value="{{ Auth::user()->id }}"/>
        </div>
        <div class="title">
            <h2>質問タイトル</h2>
            <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}"/>
            <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
        </div>
        <div class="body">
            <h2>質問内容詳細</h2>
            <textarea name="question[body]" placeholder="質問内容詳細">{{ old('question.body') }}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
        </div>
        <div>
            <h2>カテゴリー</h2>
            @foreach($categories as $category)
                <label>
                    <input type="checkbox" value="{{ $category->id }}" name="categories_array[]" {{ in_array($category->id, old('categories_array', [])) ? 'checked' : '' }}>
                        {{$category->name}}
                    </input>
                </label>
            @endforeach
        </div>
        <div class="images">
            <input type="file" name="images[]" multiple/>
        </div>
        <input type="submit" value="保存"/>
    </form>
    <div class="footer">
        <a href="/" class="underline">戻る</a>
    </div>
</x-app-layout>