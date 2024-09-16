<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionLike;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeQuestion(Request $request)
    {
        $user_id = \Auth::id();
        //jsのfetchメソッドで記事のidを送信しているため受け取ります。
        $question_id = $request->question_id;
        //自身がいいね済みなのか判定します
        $alreadyLiked = QuestionLike::where('user_id', $user_id)->where('question_id', $question_id)->first();

        if (!$alreadyLiked) {
        //こちらはいいねをしていない場合の処理です。つまり、post_likesテーブルに自身のid（user_id）といいねをした記事のid（post_id）を保存する処理になります。
            // $like = new QuestionLike();
            // $like->question_id = $question_id;
            // $like->user_id = $user_id;
            // $like->save();
            $question = Question::find($question_id);
            $question->question_likes()->attach($user_id);
        } else {
            //すでにいいねをしていた場合は、以下のようにpost_likesテーブルからレコードを削除します。
            QuestionLike::where('question_id', $question_id)->where('user_id', $user_id)->delete();
        }
        //ビューにその記事のいいね数を渡すため、いいね数を計算しています。
        $question = Question::where('id', $question_id)->first();
        $likesCount = $question->question_likes->count();

        $param = [
            'likesCount' =>  $likesCount,
        ];
        //ビューにいいね数を渡しています。名前は上記のlikesCountとなるため、フロントでlikesCountといった表記で受け取っているのがわかると思います。
        return response()->json($param);
    }
}
