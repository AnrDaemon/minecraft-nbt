<?php
/** Minecraft NBT TAG_Byte class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Byte
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return unpack('c', $file->fread(1))[1];
  }

// TAG_Value

  public static function store($value)
  {
    if($value < -128 || $value > 127)
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('c', (int)$value);
  }
}
