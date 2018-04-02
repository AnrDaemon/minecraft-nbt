<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: Tag.php 280 2018-03-27 16:05:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource,
  AnrDaemon\Minecraft\Interfaces\NbtTag;

abstract class Tag
implements NbtTag, \JsonSerializable, \Serializable
{
  public $name = null;

  abstract public function __debugInfo();

  public function __construct($name = null)
  {
    $this->name = isset($name) ? (string)$name : null;
  }

// NbtTag

  abstract public static function readFrom(NbtSource $file);

  public static function createFrom(NbtSource $file)
  {
    $_type = Dictionary::mapType($file->fread(1));
    return $_type::createFrom($file);
  }

  public function nbtSerialize()
  {
    return isset($this->name) ? Dictionary::mapName(get_called_class()) . TAG_String::store($this->name) : '';
  }

// JsonSerializable

  abstract public function jsonSerialize();

// Serializable

  abstract public function serialize();
  abstract public function unserialize($blob);
}
