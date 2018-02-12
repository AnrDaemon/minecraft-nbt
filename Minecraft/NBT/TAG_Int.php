<?php
/** Minecraft NBT TAG_Int class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Int
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return Reader::convert('l', $file->fread(4));
  }

// TAG_Value

  public static function store($value)
  {
    if($value < -2147483648 || $value > 2147483647)
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('N', (int)$value);
  }
}
