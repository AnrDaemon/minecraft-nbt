<?php

/** Minecraft NBT TAG_List class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

final class TAG_List
extends TAG_Array
{
  protected $type;

  // TAG_Array

  protected function validate($value)
  {
    if (!is_subclass_of($value, __NAMESPACE__ . '\\Tag'))
      throw new \InvalidArgumentException("Elements of the list must be NBT tags. (And not 'End' tags!)");

    if (!isset($this->type))
      $this->type = get_class($value);

    if (get_class($value) !== $this->type)
      throw new \InvalidArgumentException('All elements of the list must be of the same type.');

    if (isset($value->name))
    {
      $value = clone $value;
      $value->name = null;
    }

    return $value;
  }

  protected function store(): iterable
  {
    yield Dictionary::mapName($this->type ?: 'TAG_End');
    yield TAG_Int::store(count($this->content));
    foreach ($this->content as $value)
    {
      yield $this->validate($value)->nbtSerialize();
    }
  }

  // NbtTag

  /** Read the tag from the file
   *
   * @param NbtSource $file
   * @param TAG_Array|null $into {@deprecated}
   * @return TAG_Array
   */
  public static function readFrom(NbtSource $file): NbtTag
  {
    $self = new static();
    $type = $self->type = Dictionary::mapType($file->fread(1));
    $size = TAG_Int::readFrom($file)->value;

    for ($i = 0; $i < $size; $i++)
      $self[] = $type::readFrom($file);

    return $self;
  }
}
