<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Long
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return Reader::convert('q', $file->fread(8));
  }

// TAG_Value
  public static function store($value)
  {
    return Writer::convert('q', (int)$value);
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
