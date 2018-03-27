<?php
/** Minecraft NBT TAG_Value base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtTag;

abstract class TAG_Value
extends Tag
implements NbtTag
{
  public $value = null;

  abstract public static function store($value);

  public function __construct($name = null, $value = null)
  {
    $this->name = isset($name) ? (string)$name : null;
    $this->value = is_a($value, __CLASS__) ? $value->value : $value;
  }

  public function __toString()
  {
    return $this->value;
  }

// Tag

  public function __debugInfo()
  {
    return ['name' => $this->name, 'value' => $this->value];
  }

// NbtTag

  abstract public static function readFrom(Reader $file);

  public static function createFrom(Reader $file)
  {
    return new static(TAG_String::readFrom($file), static::readFrom($file));
  }

  public function save(\SplFileObject $file)
  {
    return parent::save($file) + $file->fwrite(static::store($this->value));
  }

// JsonSerializable

  public function jsonSerialize()
  {
    error_log(__METHOD__);
    //return (object)[];
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
