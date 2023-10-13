<?php
/*
 * File name: HotelCast.php
 * Last modified: 2022.02.15 at 13:33:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Casts;

use App\Models\Hotel;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

/**
 * Class HotelCast
 * @package App\Casts
 */
class HotelCast implements CastsAttributes
{

    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes): Hotel
    {
        $decodedValue = json_decode($value, true);
        $hotel = Hotel::find($decodedValue['id']);
        // hotel exist in database
        if (!empty($hotel)) {
            return $hotel;
        }
        // if not exist the clone will loaded
        // create new hotel based on values stored on database
        $hotel = new Hotel($decodedValue);
        // push id attribute fillable array
        array_push($hotel->fillable, 'id');
        // assign the id to hotel object
        $hotel->id = $decodedValue['id'];
        return $hotel;
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes): array
    {
//        if (!$value instanceof \Eloquent) {
//            throw new InvalidArgumentException('The given value is not an Hotel instance.');
//        }
        return [
            'hotel' => json_encode([
                'id' => $value['id'],
                'name' => $value['name'],
                'phone_number' => $value['phone_number'],
                'mobile_number' => $value['mobile_number'],
            ])
        ];
    }
}
