<?php
/** Minecraft NBT TAG_Double class.
*
* @version $Id: TAG_Double.php 280 2018-03-27 16:05:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

if(\strlen(\pack('E', 1.2)) <> 8)
  \trigger_error('Double type byte size needs to be 8. Call ambulance.', E_USER_ERROR);

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;

final class TAG_Double
extends TAG_Value
{
// TAG_Value

  public static function store($value)
  {
    return pack('E', $value);
  }

// NbtTag

  public static function readFrom(NbtSource $file)
  {
    return new static(null, unpack('E', $file->fread(8))[1]);
  }
}
