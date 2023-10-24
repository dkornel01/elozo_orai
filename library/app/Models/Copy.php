<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected  $primaryKey = 'copy_id';

    protected $fillable = [
        'hardcovered',
        'status',
        'publication',
        'book_id'
    ];
    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
    public function lending(){
        return $this->hasMany(Lending::class, 'copy_id', 'copy_id');
    }

}
