<?php

namespace App;

use App\Helper\Common;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TaskFiles extends Model
{
    use SoftDeletes;

    public function getFileAttribute($value)
    {
        return Storage::url($value);
    }

    public function getFileSizeAttribute()
    {
        $bytes = filesize(ltrim($this->file,"/"));

        return Common::filesizecalc($bytes);
    }

    public function getFileTypeAttribute(){
        return Common::filetype(ltrim($this->file,"/"));
    }

    public function getFilesUserInfoAttribute()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getFilesCreatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    public function getFilesUpdatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->updated_at));
    }

    public function getFileAddTimeAttribute()
    {
        Carbon::setLocale('tr');
        $simdiki_tarih = Carbon::now('Europe/Istanbul');
        $ileriki_tarih = Carbon::parse($this->created_at);

        return ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false)).' eklendi';
    }

    public function getFileEditTimeAttribute()
    {
        Carbon::setLocale('tr');
        $simdiki_tarih = Carbon::now('Europe/Istanbul');
        $ileriki_tarih = Carbon::parse($this->updated_at);

        return ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false)).' düzenlendi';
    }
}
