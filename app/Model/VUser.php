<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

/**
 * @property int $id 
 * @property string $username 
 * @property string $password 
 * @property string $email 
 * @property int $status 
 * @property string $createdAt 
 * @property string $updatedAt 
 * @property string $avatar 
 * @property string $phone 
 */
class VUser extends Model implements CacheableInterface
{
    use Cacheable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'v_users';
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
    protected $casts = ['id' => 'integer', 'status' => 'integer'];

    /**
     * 缓存 10 分钟，返回 null 则使用配置文件中设置的超时时间
     * @return int|null
     */
    public function getCacheTTL(): ?int
    {
        return 60*60;
    }
}