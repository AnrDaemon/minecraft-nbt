<?php
/** Minecraft NBT TAG_Float class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

if(\strlen(\pack('G', 1.2)) <> 4)
  \trigger_error('Float type byte size needs to be 4. Call ambulance.', E_USER_ERROR);

final class TAG_Float
extends TAG_Value
{
// TAG_Value

  public static function store($value)
  {
    return pack('G', $value);
  }

// NbtTag

  public static function readFrom(Reader $file)
  {
    return new static(null, unpack('G', $file->fread(4))[1]);
  }
}
