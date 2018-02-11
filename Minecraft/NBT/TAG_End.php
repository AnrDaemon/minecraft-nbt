<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_End
extends Tag
{
  public static function readFrom(Reader $file)
  {
    throw new \BadMethodCallException('You may not retrieve something that exists only as a concept. Not really.');
  }

  public static function createFrom(Reader $file)
  {
    return new static();
  }

  public function save(\SplFileObject $file)
  {
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
