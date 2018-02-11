<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

if(strlen(pack('d', 1.2)) <> 8)
  throw new \InvalidArgumentException('Double type byte size needs to be 8. Call ambulance.');

final class TAG_Double
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return Reader::convert('d', $file->fread(8));
  }

// TAG_Value
  public static function store($value)
  {
    return Writer::convert('d', $value);
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
