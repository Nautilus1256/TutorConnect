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
    
    <script>
        //いいねボタンのhtml要素を取得します。
        const likeBtn = document.querySelector('.like-btn');
        //いいねボタンをクリックした際の処理を記述します。 
        likeBtn.addEventListener('click',async(e)=>{
            //クリックされた要素を取得しています。
            const clickedEl = e.target
            //クリックされた要素にlikedというクラスがあれば削除し、なければ付与します。これにより星の色の切り替えができます。      
            clickedEl.classList.toggle('liked')
            //記事のidを取得しています。
            const questionId = e.target.id
            //fetchメソッドを利用し、バックエンドと通信します。非同期処理のため、画面がかくついたり、真っ白になることはありません。
            const res = await fetch('/question/like',{
                //リクエストメソッドはPOST
                method: 'POST',
                headers: {
                    //Content-Typeでサーバーに送るデータの種類を伝える。今回はapplication/json
                    'Content-Type': 'application/json',
                    //csrfトークンを付与
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                //バックエンドにいいねをした記事のidを送信します。
                body: JSON.stringify({ question_id: questionId })
            })
            .then((res)=>res.json())
            .then((data)=>{
                //記事のいいね数がバックエンドからlikesCountという変数に格納されて送信されるため、それを受け取りビューに反映します。
                clickedEl.nextElementSibling.innerHTML = data.likesCount;
            })
            .catch(
            //処理がなんらかの理由で失敗した場合に実施したい処理を記述します。
            ()=>alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'))
        })
    </script>
</x-app-layout>