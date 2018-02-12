<?php
/** Minecraft NBT TAG_Short class.
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
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('n', (int)$value);
  }
}
