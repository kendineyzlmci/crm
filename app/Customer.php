<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Customer extends Model
{
    use SoftDeletes;

    public function getCustomerStatusAttribute()
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

    public function getCustomerUserInfoAttribute(){

        return User::where('id',$this->representative)->first();

    }

    public function getCustomerCreateUserInfoAttribute(){

        return User::where('id',$this->created_user)->first();

    }

    public function getCustomerCreatedAtDateAttribute(){

        return date('d.m.Y', strtotime($this->created_at));

    }

    public function getCustomerUpdatedAtDateAttribute(){

        return date('d.m.Y', strtotime($this->updated_at));

    }

    public function getCustomerCreatedAtAttribute(){

    return date('d.m.Y H:i', strtotime($this->created_at));

}

    public function getCustomerUpdatedAtAttribute(){

        return date('d.m.Y H:i', strtotime($this->updated_at));

    }

    public function getImageAttribute($value)
    {
        return Storage::url($value);
    }

    public function getCustomerTypeInfoAttribute()
    {
        $isActive = [];
        if ($this->customer_type == 1) {
            return $isActive = [
                'is_active' => 'Müşteri',
                'color'     => 'green'
            ];
        } else {
            if ($this->customer_type == 2) {
                return $isActive = [
                    'is_active' => 'Potansiyel Müşteri',
                    'color'     => 'blue'
                ];
            } else {
                return $isActive = [
                    'is_active' => 'Müşteri Değil',
                    'color'     => 'orange'
                ];
            }
        }
    }
}
