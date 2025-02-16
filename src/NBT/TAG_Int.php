<?php

/** Minecraft NBT TAG_Int class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Int
extends TAG_Value
{
  // TAG_Value

  public static function store($value): string
  {
    if ($value < -2147483648 || $value > 2147483647)
      throw new \RangeException('Value is outside allowed range for a given type.');

    return pack('N', (int)$value);
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
    return new static(null, Dictionary::unpack('l', $file->fread(4)));
  }
}
