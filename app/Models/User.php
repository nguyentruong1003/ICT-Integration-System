<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    protected function fullTextWildcards($term)
   {
       // removing symbols used by MySQL
       $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
       $term = str_replace($reservedSymbols, '', $term);

       $words = explode(' ', $term);

       foreach ($words as $key => $word) {
           /*
            * applying + operator (required word) only big words
            * because smaller ones are not indexed by mysql
            */
           if (strlen($word) >= 1) {
               $words[$key] = '+' . $word  . '*';
           }
       }
       
       $searchTerm = implode(' ', $words);

       return $searchTerm;
   }

   public function scopeFullTextSearch($query, $columns, $term)
   {
       $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

       return $query;
   }
}
