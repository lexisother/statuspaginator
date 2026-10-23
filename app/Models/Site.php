<?php

namespace App\Models;

use App\Enums\SiteType;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'url',
        'type',
        'data',
    ];

    protected $casts = [
        'data' => AsArrayObject::class
    ];

    public function isStaging() {
        return $this->type === SiteType::Staging->value;
    }

    public function isDev() {
        return (isset($this->data['meta']['environment']) && $this->data['meta']['environment'] === 'dev')
            || (isset($this->data['meta']['isDev']) && $this->data['meta']['isDev']);
    }

    public function setUpdates() {
        if (!$this->data) return;
        if ($this->data['craft']['updates']['total'] > 0) $this->updateAvailable = true;
        if ($this->data['craft']['updates']['critical']) $this->criticalUpdate = true;
        $this->data['craft']['updates'] = $this->data['craft']['updates']['updates'];
    }
}
