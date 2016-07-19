<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: TAG_End.php 181 2016-07-18 15:39:23Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag,
  SplFileObject;

final class TAG_End
  extends Tag
  implements NbtTag
{
  public static function readFrom(Reader $file)
  {
    throw new BadMethodCallException('You may not retrieve something that exists only as a concept. Not really.');
  }

  public static function createFrom(Reader $file)
  {
    \tool::fprint("Creating " . get_called_class());
    return new static();
  }

  public function save(SplFileObject $file)
  {
    \tool::fprint("Saving ... " . get_called_class());
    return $file->fwrite(Dictionary::mapName($this->id));
  }

  public function __toString()
  {
    return;
  }

  public function __debugInfo()
  {
    return [];
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