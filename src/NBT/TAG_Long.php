<?php
/** Minecraft NBT TAG_Long class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;

final class TAG_Long
extends TAG_Value
{
// TAG_Value

  public static function store($value)
  {
    return pack('J', (int)$value);
  }

// NbtTag

  public static function readFrom(NbtSource $file)
  {
    return new static(null, Dictionary::unpack('q', $file->fread(8)));
  }
}
