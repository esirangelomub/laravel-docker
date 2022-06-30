<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'file_size',
        'path',
        'directories_id'
    ];

    /**
     *
     * @var array<string>
     */
    protected $casts = [
        'name' => 'string',
        'file_size' => 'decimal:0',
        'path' => 'string',
        'directories_id' => 'integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function directory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Directory::class, 'directories_id');
    }
}
