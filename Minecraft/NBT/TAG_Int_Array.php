<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag,
  SplFileObject,
  RuntimeException;

final class TAG_Int_Array
  extends TAG_Array
  implements NbtTag
{
  public static function readFrom(Reader $file, TAG_Array $into = null)
  {
    \tool::fprint("Reading ... " . get_called_class() . "::" . __FUNCTION__);
    $self = $into ?: new static();
    $size = TAG_Int::readFrom($file);

    if(\tool::debug())
      \tool::fprint("Reading " . $size . " items.");

    for($i = 0; $i < $size; $i++)
      $self[] = TAG_Int::readFrom($file);

    if(\tool::debug())
      \tool::fprint("Read " . count($self) . " items.");

    return $self;
  }

  public function save(SplFileObject $file)
  {
    $result = parent::save($file) + $file->fwrite(TAG_Int::store(count($this->content)));

    if(\tool::debug())
      \tool::fprint("Storing " . count($this->content) . " values @{$file->ftell()} ...");

    ksort($this->content);
    foreach($this->content as $value)
    {
      $result += $file->fwrite(TAG_Int::store($value));
    }

    return $result;
  }

// JsonSerializable
  public function jsonSerialize()
  {
    error_log(__METHOD__);
  }

// Serializable
  public function serialize()
  {
    error_log(__METHOD__);
  }

  public function unserialize($blob)
  {
    error_log(__METHOD__);
    error_log($blob);
  }
}
