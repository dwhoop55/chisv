<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentForm extends Model implements EnrollmentFormInterface
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Function returning the value of a form
     * for lottery
     *
     * @return integer
     */
    public function lotteryValue()
    {
        $value = 0;
        foreach ($this->attributes as $attributeKey => $attributeValue) {
            switch ($attributeKey) {
                case 'know_city':
                    $value += $attributeValue;
                    break;
                case 'attended_before':
                    $value += $attributeValue;
                    break;
                case 'sved_before':
                    $value += $attributeValue;
                    break;
                default:
                    break;
            }
            dump($attributeKey, $attributeValue, $value);
        }
        return $value;
    }
}