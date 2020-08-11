<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use SoftDeletes;

    public function getCreatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    public function getUpdatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->updated_on));
    }

    public function getDomainRegisterAttribute()
    {
        return date('d.m.Y', strtotime($this->registered_on));
    }

    public function getDomainUpdateAttribute()
    {
        return date('d.m.Y', strtotime($this->updated_on));
    }

    public function getDomainExpiresAttribute()
    {
        return date('d.m.Y', strtotime($this->expires_on));
    }

    public function getDeadlineAttribute()
    {
        Carbon::setLocale('tr');
        $simdiki_tarih = Carbon::now('Europe/Istanbul');
        $ileriki_tarih = Carbon::parse($this->expires_on);

        if($ileriki_tarih<$simdiki_tarih){
            $deadline = '<span class="red-text">'.ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false)).'</span>';
        }elseif($ileriki_tarih==$simdiki_tarih){
            $deadline = '<span class="orange-text">Son Gün</span>';
        }elseif($ileriki_tarih>$simdiki_tarih){
            $deadline = '<span class="green-text">'.ucwords($ileriki_tarih->diffForHumans($simdiki_tarih, false)).'</span>';
        }
        echo $deadline;
    }

    public function getDomainSslAttribute(){
        if($this->ssl==0){
            echo '<span class="chip red lighten-5"><span class="red-text">SSL Yok</span></span>';
        }else{
            echo '<span class="chip green lighten-5"><span class="green-text">SSL Var</span></span>';
        }
    }

    public function getDomainAgencyAttribute(){
        if($this->agency==0){
            return "Bizde";
        }else{
            return "Bizde Değil";
        }
    }

    public function getDomainStatusAttribute()
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

    public function getDomainCreateUserInfoAttribute()
    {
        return User::where('id', $this->user_id)->first();
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

    public function getDomainRenewalStatusAttribute(){
        if($this->renewal_status==0){
            return "Yenilendi";
        }else if($this->renewal_status==1){
            return "Yenilenecek";
        }else if($this->renewal_status==2){
            return "Yenilenmeyecek";
        }else if($this->renewal_status==3){
            return "Beklemede";
        }else if($this->renewal_status==4){
            return "Görüşülüyor";
        }else if($this->renewal_status==5){
            return "Bizde Değil";
        }
    }

    public function getDomainregistrarAttribute(){
        if($this->registrar==0){
            return "Diğer";
        }else if($this->registrar==1){
            return "İsim Tescil";
        }else if($this->registrar==2){
            return "Natro";
        }else if($this->registrar==3){
            return "İhs";
        }else if($this->registrar==4){
            return "Metunic";
        }else if($this->registrar==5){
            return "Turhost";
        }
    }

    public function getDomainHostingAttribute(){
        if($this->hosting==0){
            return "Diğer";
        }else if($this->hosting==1){
            return "Aysima 1";
        }else if($this->hosting==2){
            return "Aysima 2";
        }else if($this->hosting==3){
            return "Aysima 3";
        }else if($this->hosting==4){
            return "Turhost";
        }else if($this->hosting==5){
            return "Natro";
        }else if($this->hosting==5){
            return "İsimtescil";
        }else if($this->hosting==5){
            return "Bizde Değil";
        }
    }
}
