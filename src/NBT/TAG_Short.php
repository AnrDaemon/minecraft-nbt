<?php
/** Minecraft NBT TAG_Short class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;

final class TAG_Short
extends TAG_Value
{
// TAG_Value

  public static function store($value)
  {
    if($value < -32768 || $value > 32767)
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('n', (int)$value);
  }

// NbtTag

  public static function readFrom(NbtSource $file)
  {
    return new static(null, Dictionary::unpack('s', $file->fread(2)));
  }
}
