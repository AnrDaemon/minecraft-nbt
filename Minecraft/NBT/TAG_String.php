<?php
/** Minecraft NBT TAG_String class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_String
extends TAG_Value
{
  public static function readFrom(Reader $file)
  {
    return (string)$file->fread(TAG_Short::readFrom($file));
  }

// TAG_Value

  public static function store($value)
  {
    $len = strlen($value);
    if($len < 0 || $len > 32767)
      throw new \UnexpectedValueException('Valid string length range is 0..32767.');

    return TAG_Short::store($len) . $value;
  }
}
