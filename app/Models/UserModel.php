<?php

namespace App\Models;

use App\Models\LevelModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    public function stok()
    {
        return $this->hasMany(StokModel::class, 'user_id', 'user_id');
    }
}
