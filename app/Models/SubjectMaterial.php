<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectMaterial extends Model
{
    protected $fillable = [
        'subject_code',
        'teacher_id',
        'title',
        'description',
        'category',
        'type',
        'file_path',
        'file_extension',
        'external_url',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // YouTube link converted to Embed URL
    public function getYoutubeEmbedUrlAttribute()
    {
        if ($this->type !== 'youtube' || ! $this->external_url) {
            return null;
        }
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->external_url, $matches);

        return isset($matches[1]) ? "https://www.youtube.com/embed/{$matches[1]}" : null;
    }
}
