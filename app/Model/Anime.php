<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 */
class Anime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public static function timeList($where){

       return Anime::select("latestName","id","name","newUpdateAt","weekday","coverSmallImg")
            ->where($where)
            ->get();
    }
}