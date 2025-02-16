<?php

/** Minecraft NBT TAG_Int_Array class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_Int_Array
extends TAG_Scalar_Array
{
  // TAG_Array

  protected function store(): iterable
  {
    yield TAG_Int::store(count($this->content));
    foreach ($this->content as $value)
    {
      yield TAG_Int::store($value);
    }
  }

  // NbtTag

  public static function readFrom(NbtSource $file, TAG_Array $into = null): NbtTag
  {
    $self = $into ?: new static();
    $size = TAG_Int::readFrom($file)->value;

    for ($i = 0; $i < $size; $i++)
      $self[] = TAG_Int::readFrom($file);

    return $self;
  }
}
