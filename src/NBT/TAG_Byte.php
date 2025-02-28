<?php

/** Minecraft NBT TAG_Byte class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Byte
extends TAG_Value
{
  // TAG_Value

  public static function store($value): string
  {
    if ($value < -128 || $value > 127)
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('c', (int)$value);
  }

  // NbtTag

  public static function readFrom(NbtSource $file): NbtTag
  {
    return new static(null, unpack('c', $file->fread(1))[1]);
  }
}
