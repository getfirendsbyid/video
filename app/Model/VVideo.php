<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $title 
 * @property string $coverImgUrl 
 * @property int $animeId 
 * @property int $animeConllentId 
 * @property string $videoUrl 
 * @property string $createdAt 
 * @property string $updatedAt 
 */
class VVideo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'v_video';
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
    protected $casts = ['id' => 'integer', 'animeId' => 'integer', 'animeConllentId' => 'integer'];
}