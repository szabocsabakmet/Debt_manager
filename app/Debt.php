<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $guarded=[];

    public function get_payer_email($item){
        $email=(DB::table('users')->where('id',$item)->first('email'))->email;
        return $email;
    }
}
