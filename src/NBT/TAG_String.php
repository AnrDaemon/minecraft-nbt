<?php

/** Minecraft NBT TAG_String class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_String
extends TAG_Value
{
  // TAG_Value

  public static function store($value): string
  {
    $len = strlen($value);
    if ($len < 0 || $len > 32767)
      throw new \UnexpectedValueException('Valid string length range is 0..32767.');

    return TAG_Short::store($len) . $value;
  }

  // NbtTag

  public static function readFrom(NbtSource $file): NbtTag
  {
    return new static(null, $file->fread(TAG_Short::readFrom($file)->value));
  }
}
