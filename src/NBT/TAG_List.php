<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: TAG_List.php 177 2016-07-17 23:33:03Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use AnrDaemon\Minecraft\Interfaces\NbtTag,
  SplFileObject,
  LogicException, UnexpectedValueException;

final class TAG_List
  extends TAG_Array
  implements NbtTag
{
  protected $type;

  public static function readFrom(Reader $file, TAG_Array $into = null)
  {
    $self = $into ?: new static();
    $type = $self->type = Dictionary::mapType($file->fread(1));
    $size = TAG_Int::readFrom($file);

    if(\tool::debug())
      \tool::fprint("Reading $size elements of type {$self->type}");

    for($i = 0; $i < $size; $i++)
      $self[] = $type::readFrom($file);

    return $self;
  }

  public function save(SplFileObject $file)
  {
    $result = parent::save($file);
    if(isset($this->type))
      $result += $file->fwrite(Dictionary::mapName($this->type));
    else
      if(count($this->content))
        throw new UnexpectedValueException('Populated list needs an explicit type cast.');
      else
        $result += $file->fwrite(Dictionary::mapName('TAG_End'));

    $result += $file->fwrite(TAG_Int::store(count($this->content)));

    if(\tool::debug())
      \tool::fprint("Storing " . count($this->content) . " values of type {$this->type} @{$file->ftell()} ...");

    $type = $this->type;
    foreach($this->content as $index => $tag)
    {
      if(!is_object($tag))
      {
        $result += $file->fwrite($type::store($tag));
      }
      else if($tag instanceof $this->type)
      {
        if(isset($tag->name))
          throw new UnexpectedValueException("List#$index is a named tag.");

        $result += $tag->save($file);
      }
      else
        throw new UnexpectedValueException("List#$index type '" . get_class($tag) . "' doesn't match the list type '{$this->type}'.");
    }

    return $result;
  }

  public function __set($name, $value)
  {
    if($name == 'type')
      if(!isset($this->type))
      {
        $this->type = $value;
        return;
      }

    throw new LogicException("No such property '$name' or it is not writable.");
  }

  public function __get($name)
  {
    if($name == 'type')
      return $this->type;

    throw new LogicException("No such property '$name' or it is not readable.");
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
