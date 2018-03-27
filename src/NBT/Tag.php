<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtTag;

abstract class Tag
implements /*TODO:PHP7.2 NbtTag, */\JsonSerializable, \Serializable
{
  public $name = null;

  abstract public function __debugInfo();

  public function __construct($name = null)
  {
    $this->name = isset($name) ? (string)$name : null;
  }

// NbtTag

// TODO:PHP7.2 abstract public static function readFrom(Reader $file);
// TODO:PHP7.2 abstract public static function createFrom(Reader $file);

  public function save(\SplFileObject $file)
  {
    return $file->fwrite(isset($this->name) ? Dictionary::mapName(get_called_class()) . TAG_String::store($this->name) : '');
  }

// JsonSerializable

  abstract public function jsonSerialize();

// Serializable

  abstract public function serialize();
  abstract public function unserialize($blob);
}
