<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function question_likes()
    {
        return $this->belongsToMany(User::class, 'question_likes', 'question_id', 'user_id');
    }
    
    public function isLikedByAuthUser() :bool
    {
        //認証済ユーザーid（自身のid）を取得
        $authUserId = \Auth::id();
        //空の配列を定義。後続の処理で、いいねしたユーザーのidを全て格納していくときに使う。
        $likersArr = array();
        //$thisは言葉の似た通り、クラス自身を指す。具体的にはこのPostクラスをインスタンス化した際の変数のことを指す。（後続のビューで登場する$postになります）
        foreach($this->question_likes as $questionLike){
            //array_pushメソッドで第一引数に配列、第二引数に配列に格納するデータを定義し、配列を作成できる。
            //今回は$likersArrという空の配列にいいねをした全てのユーザーのidを格納している。
            array_push($likersArr,$questionLike->id);

        }
        //in_arrayメソッドを利用し、認証済ユーザーid（自身のid）が上記で作成した配列の中に存在するかどうか判定している
        if (in_array($authUserId,$likersArr)){
            //存在したらいいねをしていることになるため、trueを返す
            return true;
        }else{
            return false;
        }
    }
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
