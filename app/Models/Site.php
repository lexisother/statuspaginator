<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
        $cmsUpdates = $this->data['craft']['updates']['cms']['releases'];
        $updAvail = sizeof($cmsUpdates) > 0;

        if ($updAvail) {
            $this->updateAvailable = true;

            Arr::map($cmsUpdates, function (array $update) {
                if ($update['critical']) {
                    $this->criticalUpdate = true;
                }
            });
        }
    }
}
