<?php

/** Minecraft NBT TAG_Short class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Short
extends TAG_Value
{
  // TAG_Value

  public static function store($value): string
  {
    if ($value < -32768 || $value > 32767)
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('n', (int)$value);
  }

  // NbtTag

  /**
   * Undocumented function
   *
   * @param NbtSource $file
   * @return TAG_Value
   */
  public static function readFrom(NbtSource $file): NbtTag
  {
    return new static(null, Dictionary::unpack('s', $file->fread(2)));
  }
}
