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
  protected $id;
  public $name = null;

  public function __construct()
  {
    $this->id = get_called_class();
  }

  abstract public function __debugInfo();

// NbtTag

// TODO:PHP7.2 abstract public static function readFrom(Reader $file);
// TODO:PHP7.2 abstract public static function createFrom(Reader $file);

  public function save(\SplFileObject $file)
  {
    return $file->fwrite(isset($this->name) ? Dictionary::mapName($this->id) . TAG_String::store($this->name) : '');
  }

// JsonSerializable

  abstract public function jsonSerialize();

// Serializable

  abstract public function serialize();
  abstract public function unserialize($blob);
}
