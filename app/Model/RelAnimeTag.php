<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 */
class RelAnimeTag extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rel_anime_tag';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["tag_id","anime_id","updatedAt","createdAt"];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}