<?php

/** Minecraft NBT Tag base class.
 *
 * @version $Id$
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

  abstract public static function readFrom(NbtSource $file): NbtTag;

  /** Read a tag from the stream
   *
   * This factory method reads the tag type byte from the stream,
   * maps it to the correct tag class and invokes the appropriate
   * child factory method.
   *
   * @param NbtSource $file
   * @return Tag
   */
  public static function createFrom(NbtSource $file): NbtTag
  {
    $_type = Dictionary::mapType($file->fread(1));
    return $_type::createFrom($file);
  }

  public function nbtSerialize(): string
  {
    return isset($this->name) ? Dictionary::mapName(get_called_class()) . TAG_String::store($this->name) : '';
  }

  // JsonSerializable

  abstract public function jsonSerialize(): mixed;

  // Serializable

  abstract public function serialize();
  abstract public function unserialize($blob);
}
