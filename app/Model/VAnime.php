<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $anime 
 * @property string $desc 
 * @property int $episode 
 * @property string $playTime 
 * @property string $cratedAt 
 * @property string $updatedAt 
 */
class VAnime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'v_anime';
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
    protected $casts = ['id' => 'integer', 'episode' => 'integer'];
}