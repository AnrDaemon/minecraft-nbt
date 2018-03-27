<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: TAG_Int.php 177 2016-07-17 23:33:03Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag,
  RangeException;

final class TAG_Int
  extends TAG_Value
  implements NbtTag
{
  public static function readFrom(Reader $file)
  {
    \tool::fprint("Reading ... " . get_called_class() . "::" . __FUNCTION__);
    return Reader::convert('l', $file->fread(4));
  }

// TAG_Value
  public static function store($value)
  {
    if($value < -2147483648 || $value > 2147483647)
      throw new RangeException('Value is out of allowed range for given type.');

    if(\tool::debug())
      \tool::fprint("Storing " . get_called_class() . ":$value");

    return Writer::convert('l', (int)$value);
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
