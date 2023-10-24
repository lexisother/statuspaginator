<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'url',
        'data'
    ];

    protected $casts = [
        'data' => AsArrayObject::class
    ];

    public function setUpdates() {
        if (!$this->data) return;
        if ($this->data['craft']['updates']['total'] > 0) $this->updateAvailable = true;
        if ($this->data['craft']['updates']['critical']) $this->criticalUpdate = true;
        $this->data['craft']['updates'] = $this->data['craft']['updates']['updates'];
    }
}
