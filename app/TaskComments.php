<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class TaskComments extends Model
{
    use SoftDeletes;

    public function getCommentUserInfoAttribute()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getCommentCreatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    public function getCommentUpdatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->updated_at));
    }

    public function getCommentCreatedAtHourAttribute()
    {
        return date('H:i', strtotime($this->created_at));
    }

    public function getCommentUpdatedAtHourAttribute()
    {
        return date('H:i', strtotime($this->updated_at));
    }

    public function getCommentAddTimeAttribute()
    {
        Carbon::setLocale('tr');
        $simdiki_tarih = Carbon::now('Europe/Istanbul');
        $ileriki_tarih = Carbon::parse($this->created_at);

        return ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false).' eklendi');
    }

    public function getCommentEditTimeAttribute()
    {
        Carbon::setLocale('tr');
        $simdiki_tarih = Carbon::now('Europe/Istanbul');
        $ileriki_tarih = Carbon::parse($this->updated_at);

        return ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false).' düzenlendi');
    }

    public function getLikeControlAttribute(){

        $like = TaskCommentsLike::where('comment_id',$this->id)->where('user_id',Auth::id())->count();
        if($like<=0){
            return "beğenmemiş";
        }else{
            return "yellow-text";
        }

    }

    public function getLikeCountAttribute(){

        return TaskCommentsLike::where('comment_id',$this->id)->count();

    }
}
