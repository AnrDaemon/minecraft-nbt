<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

if(strlen(pack('f', 1.2)) <> 4)
  throw new \InvalidArgumentException('Float type byte size needs to be 4. Call ambulance.');

final class TAG_Float
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return Reader::convert('f', $file->fread(4));
  }

// TAG_Value
  public static function store($value)
  {
    return Writer::convert('f', $value);
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
