<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 */
class RelAnimeSeries extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rel_anime_series';
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

    public static function seriesList(): \Hyperf\Utils\Collection
    {
        return RelAnimeSeries::leftJoin("anime","rel_anime_series.animeId","anime.id")
            ->leftJoin("anime_series","rel_anime_series.seriesId","anime_series.id")
            ->select('anime.id','anime.name as title','anime.coverSmallImg as src',"rel_anime_series.seriesId")
            ->get();
    }
}