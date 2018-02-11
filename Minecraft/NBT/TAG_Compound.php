<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

final class TAG_Compound
extends TAG_Array
{
  public static function readFrom(Reader $file, TAG_Array $into = null)
  {
    $self = $into ?: new static();
    while($tag = $file->read())
      if($tag instanceof TAG_End)
        break;
      else
        $self[] = $tag;

    return $self;
  }

  public function save(\SplFileObject $file)
  {
    $result = parent::save($file);

    foreach($this->content as $tag)
    { // TODO: Check if tag is TAG_End at insetion times.
      if($tag instanceof TAG_End)
        break;

      $result += $tag->save($file);
    }


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
