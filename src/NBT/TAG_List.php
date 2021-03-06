<?php
/** Minecraft NBT TAG_List class.
*
* @version $Id: TAG_List.php 280 2018-03-27 16:05:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;

final class TAG_List
extends TAG_Array
{
  protected $type;

// TAG_Array

  protected function validate($value)
  {
    if(!is_subclass_of($value, __NAMESPACE__ . '\\Tag'))
      throw new \InvalidArgumentException("Elements of the list must be NBT tags. (And not 'End' tags!)");

    if(!isset($this->type))
      $this->type = get_class($value);

    if(get_class($value) !== $this->type)
      throw new \InvalidArgumentException('All elements of the list must be of the same type.');

    if(isset($value->name))
    {
      $value = clone $value;
      $value->name = null;
    }

    return $value;
  }

  protected function store()
  {
    yield Dictionary::mapName($this->type ?: 'TAG_End');
    yield TAG_Int::store(count($this->content));
    foreach($this->content as $value)
    {
      yield $this->validate($value)->nbtSerialize();
    }
  }

// NbtTag

  public static function readFrom(NbtSource $file, TAG_Array $into = null)
  {
    $self = $into ?: new static();
    $type = $self->type = Dictionary::mapType($file->fread(1));
    $size = TAG_Int::readFrom($file)->value;

    for($i = 0; $i < $size; $i++)
      $self[] = $type::readFrom($file);

    return $self;
  }
}
