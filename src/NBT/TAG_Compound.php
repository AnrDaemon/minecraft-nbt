<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: TAG_Compound.php 177 2016-07-17 23:33:03Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag,
  SplFileObject;

final class TAG_Compound
  extends TAG_Array
  implements NbtTag
{
  public static function readFrom(Reader $file, TAG_Array $into = null)
  {
    \tool::fprint("Reading ... " . get_called_class() . "::" . __FUNCTION__);
    $self = $into ?: new static();
    while($tag = $file->read())
      if($tag instanceof TAG_End)
        break;
      else
        $self[] = $tag;

    return $self;
  }

  public function save(SplFileObject $file)
  {
    $result = parent::save($file);

    if(\tool::debug())
      \tool::fprint("Storing " . count($this->content) . " values @{$file->ftell()} ...");

    $i = 1;
    foreach($this->content as $tag)
    {
      if($tag instanceof TAG_End)
        break;
      $result += $tag->save($file);
      $i++;
    }

    if(\tool::debug())
      if($i < count($this->content))
        # TODO: Check if the tag is TAG_End at insetion times.
        \tool::fprint("Stored $i values! Don't stuff TAG_End in the middle of compound tags!");

    return $result + $file->fwrite(Dictionary::mapName("TAG_End"));
  }

// JsonSerializable
  public function jsonSerialize()
  {
    return '{}';
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
