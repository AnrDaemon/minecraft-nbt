<?php
/** Minecraft NBT TAG_Byte_Array class.
*
* @version $Id: TAG_Byte_Array.php 280 2018-03-27 16:05:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;

final class TAG_Byte_Array
extends TAG_Scalar_Array
{
// TAG_Array

  protected function store()
  {
    yield TAG_Int::store(count($this->content));
    foreach($this->content as $value)
    {
      yield TAG_Byte::store($value);
    }
  }

// NbtTag

  public static function readFrom(NbtSource $file, TAG_Array $into = null)
  {
    $self = $into ?: new static();
    $size = TAG_Int::readFrom($file)->value;

    for($i = 0; $i < $size; $i++)
      $self[] = TAG_Byte::readFrom($file);

    return $self;
  }
}
