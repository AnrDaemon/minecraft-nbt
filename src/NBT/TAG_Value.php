<?php

/** Minecraft NBT TAG_Value base class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

abstract class TAG_Value
extends Tag
{
  public $value = null;

  /**
   *
   * @param mixed $value
   * @return string
   */
  abstract public static function store($value): string;

  public function __construct($name = null, $value = null)
  {
    parent::__construct($name);
    $this->value = is_subclass_of($value, __CLASS__) ? $value->value : $value;
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

  /** Read a name-value tag pair from the stream
   *
   * @param NbtSource $file
   * @return TAG_Value
   */
  public static function createFrom(NbtSource $file): NbtTag
  {
    return new static(TAG_String::readFrom($file), static::readFrom($file));
  }

  public function nbtSerialize(): string
  {
    return parent::nbtSerialize() . static::store($this->value);
  }

  // JsonSerializable

  public function jsonSerialize(): mixed
  {
    error_log(__METHOD__);
    return [$this->name => $this->value,];
  }

  // Serializable

  public function serialize()
  {
    return serialize(['name' => $this->name, 'value' => $this->value]);
  }

  public function unserialize($blob)
  {
    $data = unserialize($blob);
    $self = new static($data['name'], $data['value']);
    $this->name = $self->name;
    $this->value = $self->value;
  }
}
