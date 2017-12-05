<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag,
  RangeException;

final class TAG_Byte
  extends TAG_Value
  implements NbtTag
{
  public static function readFrom(Reader $file)
  {
    \tool::fprint("Reading ... " . get_called_class() . "::" . __FUNCTION__);
    return unpack('c', $file->fread(1))[1];
  }

// TAG_Value
  public static function store($value)
  {
    if($value < -128 || $value > 127)
      throw new RangeException('Value is out of allowed range for given type.');

    if(\tool::debug())
      \tool::fprint("Storing " . get_called_class() . ":$value");

    return pack('c', (int)$value);
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
