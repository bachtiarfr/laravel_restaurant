<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Log extends Model
{
    static function Log_activity($log)
    {
        DB::table('logs')->insert(
            [
                'user_id' => Auth::user()->id,
                'description' => $log,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
