<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'feedback_type',
        'rating',
        'subject',
        'feedback_message',
        'specific_area',
        'priority',
        'ease_of_use',
        'performance',
        'design',
        'would_recommend',
        'additional_features',
        'name',
        'email',
        'ip_address',
        'user_agent',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'would_recommend' => 'boolean',
        'rating' => 'integer',
        'ease_of_use' => 'integer',
        'performance' => 'integer',
        'design' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scope for filtering by status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByFeedbackType($query, $type)
    {
        return $query->where('feedback_type', $type);
    }
}
