<?php

namespace App\DTO;

use Carbon\Carbon;
use Carbon\Traits\Cast;
use Livewire\Wireable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class Execution extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public int $id,
        #[WithCast(DateTimeInterfaceCast::class, ['Y-m-d\TH:i:s.vp', 'Y-m-d\TH:i:sP', 'Y-m-d H:i:s'])]
        public Carbon $start_date,
        #[WithCast(DateTimeInterfaceCast::class, ['Y-m-d\TH:i:s.vp', 'Y-m-d\TH:i:sP', 'Y-m-d H:i:s'])]
        public Carbon $finish_date,
    ) {}
}
