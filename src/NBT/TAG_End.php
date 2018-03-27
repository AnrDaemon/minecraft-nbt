<?php
/** Minecraft NBT TAG_End class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_End
implements NbtTag
{
  public function __toString()
  {
    return;
  }

// NbtTag

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
    return $file->fwrite(Dictionary::mapName(get_called_class()));
  }
}
