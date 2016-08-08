<?php
/**
 * Created by PhpStorm.
 * User: andreasschacht
 * Date: 24.06.16
 * Time: 17:26
 */

namespace Kaliber5\DoctrineExtraBundle\DoctrineExtensions\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;

/**
 * Class UTCDateTimeType
 *
 * This class converts datetime types with a utc timezone
 *
 * @package Kaliber5\DoctrineExtraBundle\DoctrineExtensions\DBAL\Types
 */
class UTCDateTimeType extends DateTimeType
{
    static private $utc;

    /**
     * @param                  $value
     * @param AbstractPlatform $platform
     *
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof \DateTime) {
            $value->setTimezone(self::getUtc());
        }

        return parent::convertToDatabaseValue($value, $platform);
    }

    /**
     * @param                  $value
     * @param AbstractPlatform $platform
     *
     * @return \DateTime
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof \DateTime) {
            return $value;
        }

        $converted = \DateTime::createFromFormat(
            $platform->getDateTimeFormatString(),
            $value,
            self::getUtc()
        );

        if (!$converted) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                $platform->getDateTimeFormatString()
            );
        }

        return $converted;
    }

    /**
     * @return \DateTimeZone
     */
    protected static function getUtc()
    {
        self::$utc ? self::$utc : self::$utc = new \DateTimeZone('UTC');
        return self::$utc;
    }
}
