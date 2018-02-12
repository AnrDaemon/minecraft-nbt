<?php
/** Minecraft NBT TAG_Double class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

if(\strlen(\pack('E', 1.2)) <> 8)
  \trigger_error('Double type byte size needs to be 8. Call ambulance.', E_USER_ERROR);

final class TAG_Double
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return unpack('E', $file->fread(8))[1];
  }

// TAG_Value

  public static function store($value)
  {
    return pack('E', $value);
  }
}
