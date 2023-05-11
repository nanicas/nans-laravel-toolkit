<?php

namespace Zevitagem\LaravelToolkit\Traits;

trait AttributesResourceModel
{
    public static function getPrimaryKey()
    {
        return static::PRIMARY_KEY;
    }

    public function getPrimaryValue()
    {
        return $this->{self::getPrimaryKey()};
    }

    public function getId()
    {
        return $this->getPrimaryValue();
    }

    public function getCreatedAt()
    {
        return $this->{$this->getCreatedAtColumn()};
    }

    public function getUpdatedAt()
    {
        return $this->{$this->getUpdatedAtColumn()};
    }

    public function getFromDatetimeAttribute(string $attr, $format = null)
    {
        if (is_null($format)) {
            $format = config('template.datetime_format');
        }

        return $this->getAttribute($attr)->format($format);
    }
}
