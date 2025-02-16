<?php

/** Minecraft NBT TAG_Double class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

if (\strlen(\pack('E', 1.2)) <> 8)
  \trigger_error('Double type byte size needs to be 8. Call ambulance.', E_USER_ERROR);

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Double
extends TAG_Value
{
  // TAG_Value

  public static function store($value): string
  {
    return pack('E', $value);
  }

  // NbtTag

  public static function readFrom(NbtSource $file): NbtTag
  {
    return new static(null, unpack('E', $file->fread(8))[1]);
  }
}
