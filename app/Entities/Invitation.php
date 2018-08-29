<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Invitation extends Model
{
    protected $fillable = [
        'invited_to_name', 'invited_to_email', 'invited_by', 'email_token', 'activation_token'
    ];

    public static function isValidNewInvitation($email)
    {
        $count =  self::where('invited_to_email', $email)
            ->where('created_at', '>', Carbon::now()->subDays(2))
            ->count();

        return $count === 0;
    }


    public function scopeSearch($query, Request $search)
    {
        $query->where(
            function ($query) use ($search) {

                if (($keyword = $search->get('keyword')) !== false ) {
                    $query->where("invited_to_name", "LIKE", "%$keyword%");
                }
            }
        );

        $sortable_fields = ['invited_to_name','created_at','invited_to_email'];
        $sort_by = 'created_at';

        if (in_array($search->get('sortBy'), $sortable_fields)) {
            $sort_by = $search->get('sortBy');
        }
        $sort_order = [
            'ascending' => 'ASC',
            'descending' => 'DESC',
        ];

        $order = $sort_order[$search->get('order', 'descending')];

        return $query->orderBy($sort_by, $order);

    }

    public function statusNote()
    {
        if($this->accepted){
            return;
        }
        if($this->created_at->addDays(2)->lt(Carbon::now())){
            return 'Expired';
        } else if($this->created_at->addHours(12)->lt(Carbon::now())){
            $time_left = $this->created_at->addHours(12)->diffInHours(Carbon::now());
            return 'Left '.$time_left;
        } else {
            return 'Active';
        }
    }
}
