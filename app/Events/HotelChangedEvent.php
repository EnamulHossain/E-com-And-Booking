<?php
/*
 * File name: HotelChangedEvent.php
 * Last modified: 2022.02.02 at 21:20:43
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Events;

use App\Models\Hotel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HotelChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newHotel;

    public $oldHotel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Hotel $newHotel, Hotel $oldHotel)
    {
        //
        $this->newHotel = $newHotel;
        $this->oldHotel = $oldHotel;
    }

}
