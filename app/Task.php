<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use SoftDeletes;

    public function getTaskStatusAttribute()
    {
        $isActive = [];
        if ($this->status == 1) {
            return $isActive = [
                'is_active' => 'Aktif',
                'color'     => 'green'
            ];
        } else {
            return $isActive = [
                'is_active' => 'Pasif',
                'color'     => 'red'
            ];
        }
    }

    public function getTaskPriorityAttribute()
    {
        $isActive = [];
        if ($this->priority == 1) {
            return $isActive = [
                'is_active' => 'Normal',
                'color'     => 'green'
            ];
        } else {
            if ($this->priority == 2) {
                return $isActive = [
                    'is_active' => 'Acil',
                    'color'     => 'orange'
                ];
            } else {
                return $isActive = [
                    'is_active' => 'Acil Acil',
                    'color'     => 'red'
                ];
            }
        }
    }

    public function getTaskUserInfoAttribute()
    {
        return User::where('id', $this->task_user)->first();
    }

    public function getTaskCreateUserInfoAttribute()
    {
        return User::where('id', $this->created_user)->first();
    }

    public function getTaskCreatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    public function getTaskUpdatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->updated_at));
    }

    public function getTaskStartDateAttribute()
    {
        return date('d.m.Y', strtotime($this->start_date));
    }

    public function getTaskFinishDateAttribute()
    {
        return date('d.m.Y', strtotime($this->finish_date));
    }

    public function getDeadlineAttribute()
    {
        Carbon::setLocale('tr');
        $simdiki_tarih = Carbon::now('Europe/Istanbul');
        $ileriki_tarih = Carbon::parse($this->finish_date);

        if($ileriki_tarih<$simdiki_tarih){
            $deadline = '<span class="red-text">'.ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false)).'</span>';
        }elseif($ileriki_tarih==$simdiki_tarih){
            $deadline = '<span class="orange-text">Son Gün</span>';
        }elseif($ileriki_tarih>$simdiki_tarih){
            $deadline = '<span class="green-text">'.ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false)).'</span>';
        }
        echo $deadline;
    }

    public function getCustomerCtrlAttribute()
    {
        if ($this->customer_id == 0 || Customer::where('id', $this->customer_id)->count() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getCustomerInfoAttribute()
    {
        return Customer::where('id', $this->customer_id)->first();
    }

}
