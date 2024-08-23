<?php

namespace App\Trait;

use Morilog\Jalali\Jalalian;

trait DateConvert
{
    public function DateConvert($column='created_at'){
        return Jalalian::forge($this->column)->format('H:i:s Y/m/d');
    }
}
