<?php
/** Minecraft NBT Tag base class.
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
      throw new \LengthException('Valid string length range is 0..32767.');

    return TAG_Short::store($len) . $value;
  }

  public function __toString()
  {
    return $this->value;
  }

// JsonSerializable
  public function jsonSerialize()
  {
    error_log(__METHOD__);
  }

// Serializable
  public function serialize()
  {
    error_log(__METHOD__);
  }

  public function unserialize($blob)
  {
    error_log(__METHOD__);
    error_log($blob);
  }
}
