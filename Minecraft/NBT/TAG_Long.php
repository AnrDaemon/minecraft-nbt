<?php
/** Minecraft NBT TAG_Long class.
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
    return pack('J', (int)$value);
  }
}
