<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;

    protected $table = 'directories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'path',
        'directories_id'
    ];

    /**
     *
     * @var array<string>
     */
    protected $casts = [
        'name' => 'string',
        'path' => 'string',
        'directories_id' => 'integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(File::class, 'directories_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parent_directories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Directory::class, 'directories_id', 'id');
    }
}
