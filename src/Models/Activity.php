<?php

namespace Kishor\Activity\Models;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $guarded = [];
    /**
     * {@inheritdoc}
     */

    protected $casts = [
        'old_value' => 'json',
        'new_value' => 'json',
    ];

    protected $fillable = ['reference_id', 'reference_log_type', 'old_value', 'new_value', 'record', 'action', 'description' , 'created_by'];

    public function __construct(array $attributes = [])
    {
        if (!isset($this->table)) {
            $this->setTable(config('activitylog.table_name'));
        }
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'reference_id');
    }

}