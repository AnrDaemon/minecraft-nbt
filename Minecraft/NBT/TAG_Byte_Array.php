<?php
/** Minecraft NBT TAG_Byte_Array class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Byte_Array
extends TAG_Array
{
  public static function readFrom(Reader $file, TAG_Array $into = null)
  {
    $self = $into ?: new static();
    $size = TAG_Int::readFrom($file);

    for($i = 0; $i < $size; $i++)
      $self[] = TAG_Byte::readFrom($file);

    return $self;
  }

  public function save(\SplFileObject $file)
  {
    $result = parent::save($file) + $file->fwrite(TAG_Int::store(count($this->content)));

    ksort($this->content);
    foreach($this->content as $value)
    {
      $result += $file->fwrite(TAG_Byte::store($value));
    }

    return $result;
  }
}
