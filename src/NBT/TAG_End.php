<?php
/** Minecraft NBT TAG_End class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource,
  AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_End
implements NbtTag
{
  public function __toString()
  {
    return;
  }

// NbtTag

  public static function readFrom(NbtSource $file)
  {
    throw new \BadMethodCallException('You may not retrieve something that exists only as a concept. Not really.');
  }

  public static function createFrom(NbtSource $file)
  {
    return new static();
  }

  public function nbtSerialize()
  {
    return Dictionary::mapName(get_called_class());
  }
}
