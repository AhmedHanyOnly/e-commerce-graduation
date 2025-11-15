<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{

    protected $guarded =['id'];
    public static function action($user, $amount, $add = false,$message=null,$order_id=null)
    {
        if (!$add) {
            $amountAfterAction = $user->balance - $amount;
        } else {
            $amountAfterAction = $user->balance + $amount;
        }
        $user->update(['balance' => $amountAfterAction]);
        return self::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'is_add' => $add,
            'balance_after_action' => $amountAfterAction,
            'order_id'=>$order_id,
            'message' =>$message
        ]);
    }

}
