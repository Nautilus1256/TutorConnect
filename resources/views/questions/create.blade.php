<x-app-layout>
    <div class='my-8 rounded-2xl px-16 py-8 question-create-area'>
        <form action="/questions" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="user_id">
                <input type="hidden" name="question[user_id]" value="{{ Auth::user()->id }}"/>
            </div>
            <div class='flex flex-col gap-8'>
                <div class="flex gap-8">
                    <h2 class='flex items-center text-xl font-bold'>質問タイトル</h2>
                    <div class='flex-grow'>
                        <input type="text" name="question[title]" placeholder="タイトル" value="{{ old('question.title') }}" class='w-full rounded-2xl p-4 text-xl'/>
                        <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
                    </div>
                </div>
                <div class="flex gap-8">
                    <h2 class='flex items-center text-xl font-bold'>質問内容詳細</h2>
                    <div class='flex-grow'>
                        <textarea name="question[body]" placeholder="質問内容詳細" class='w-full rounded-2xl p-4 text-xl h-36.5'>{{ old('question.body') }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('question.body') }}</p>
                    </div>
                </div>
                <div class="flex gap-8">
                    <h2 class='flex items-center text-xl font-bold px-2.5'>カテゴリー</h2>
                    <div class='flex flex-col gap-4'>
                        @foreach($category_types as $category_type)
                            <div class='flex flex-col gap-2'>
                                <div class='question-create-category-type text-xl font-bold'>
                                    @if($category_type->name == '教科')
                                        <i class="fa-solid fa-book"></i>
                                    @elseif($category_type->name == '学年')
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    @elseif($category_type->name == '環境')
                                        <i class="fa-solid fa-house"></i>
                                    @endif
                                    <span>{{ $category_type->name }}</span>
                                </div>
                                <div class='flex gap-4'>
                                    @foreach($category_type->categories as $category)
                                        <div>
                                            <input type='checkbox' name='categories[]' value='{{ $category->id }}' {{ in_array($category->id, old('categories_array', [])) ? 'checked' : '' }}>
                                                {{ $category->name }}
                                            </input>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex gap-8">
                    <h2 class='flex items-center text-xl font-bold px-10'>画像</h2>
                    <input type="file" name="images[]" multiple/>
                </div>
                <div class="flex justify-center">
                    <div class='text-xl px-12 py-4 text-white rounded-lg font-bold text-center answer-btn'>
                        <input type="submit" value="投稿"/>
                    </div>
                </div>
            </div>
        </form>
        <div class="flex items-center justify-start pt-8">
            <a href="/" class="underline text-2xl font-bold question-create-return-btn">戻る</a>
        </div>
    </div>
    
</x-app-layout>