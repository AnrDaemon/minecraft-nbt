<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: TAG_Double.php 160 2016-07-15 20:01:45Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

if(strlen(pack('d', 1.2)) <> 8)
  throw new \InvalidArgumentException('Double type byte size needs to be 8. Call ambulance.');

use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Double
  extends TAG_Value
  implements NbtTag
{
  public static function readFrom(Reader $file)
  {
    \tool::fprint("Reading ... " . get_called_class() . "::" . __FUNCTION__);
    return Reader::convert('d', $file->fread(8));
  }

// TAG_Value
  public static function store($value)
  {
    if(\tool::debug())
      \tool::fprint("Storing " . get_called_class() . ":$value");

    return Writer::convert('d', $value);
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
