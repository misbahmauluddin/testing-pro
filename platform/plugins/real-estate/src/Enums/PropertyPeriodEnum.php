<?php

namespace Botble\RealEstate\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static PropertyPeriodEnum DAY()
 * @method static PropertyPeriodEnum MONTH()
 * @method static PropertyPeriodEnum YEAR()
 */
class PropertyPeriodEnum extends Enum
{
    public const DAY = 'day';
    public const MONTH = 'month';
    public const YEAR = 'year';
    public const HOUR = 'hour';


    /**
     * @var string
     */
    public static $langPath = 'plugins/real-estate::property.periods';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::DAY:
                return Html::tag('span', self::DAY()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            case self::MONTH:
                return Html::tag('span', self::MONTH()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::YEAR:
                return Html::tag('span', self::YEAR()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::HOUR:
                return Html::tag('span', self::HOUR()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
