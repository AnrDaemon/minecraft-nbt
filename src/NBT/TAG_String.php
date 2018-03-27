<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: TAG_String.php 160 2016-07-15 20:01:45Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_String
  extends TAG_Value
  implements NbtTag
{
  public static function readFrom(Reader $file)
  {
    \tool::fprint("Reading ... " . get_called_class());
    return (string)$file->fread(TAG_Short::readFrom($file));
  }

// TAG_Value
  public static function store($value)
  {
    $len = strlen($value);
    if($len < 0 || $len > 32767)
      throw new \LengthException('Valid string length range is 0..32767.');

    if(\tool::debug())
      \tool::fprint("Storing " . get_called_class() . ":$value");

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