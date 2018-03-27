<?php
/** Minecraft NBT TAG_Long class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Long
extends TAG_Value
{
// TAG_Value

  public static function store($value)
  {
    return pack('J', (int)$value);
  }

// NbtTag

  public static function readFrom(Reader $file)
  {
    return new static(null, Reader::convert('q', $file->fread(8)));
  }
}
