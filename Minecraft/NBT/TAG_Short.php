<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Short
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return Reader::convert('s', $file->fread(2));
  }

// TAG_Value
  public static function store($value)
  {
    if($value < -32768 || $value > 32767)
      throw new \RangeException('Value is outside allowed range for given type.');

    return Writer::convert('s', (int)$value);
  }

  public function __toString()
  {
    return $this->value;
  }

// JsonSerializable
  public function jsonSerialize()
  {
    error_log(__METHOD__);
  }

// Serializable
  public function serialize()
  {
    error_log(__METHOD__);
  }

  public function unserialize($blob)
  {
    error_log(__METHOD__);
    error_log($blob);
  }
}
