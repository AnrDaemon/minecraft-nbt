<?php

/** Minecraft NBT TAG_Compound class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Compound
extends TAG_Array
{
  // TAG_Array

  protected function validate($value)
  {
    if (!is_subclass_of($value, __NAMESPACE__ . '\\Tag'))
      throw new \InvalidArgumentException("Elements of the list must be NBT tags. (And not 'End' tags!)");

    if (!isset($value->name))
      throw new \InvalidArgumentException("Elements of the list must have a name. Even if it's an empty name.");

    return $value;
  }

  protected function store(): iterable
  {
    foreach ($this->content as $value)
      yield $this->validate($value)->nbtSerialize();

    yield Dictionary::mapName('TAG_End');
  }

  // NbtTag

  public static function readFrom(NbtSource $file, TAG_Array $into = null): NbtTag
  {
    $self = $into ?: new static();
    while ($tag = Tag::createFrom($file))
      if ($tag instanceof TAG_End)
        break;
      else
        $self[] = $tag;

    return $self;
  }
}
