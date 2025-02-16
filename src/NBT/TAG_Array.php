<?php

/** Minecraft NBT TAG_Array base class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;
use AnrDaemon\Minecraft\Interfaces\NbtTag;

abstract class TAG_Array
extends Tag
implements \ArrayAccess, \Countable, \Iterator
{
  public $name = null;
  protected $content = array();
  protected $position = 0;

  abstract protected function validate($value);
  abstract protected function store(): iterable;

  public function __construct($name = null, array $content = array())
  {
    parent::__construct($name);
    foreach ($content as $value)
    {
      $this[] = $value;
    }
  }

  // Tag

  public function __debugInfo()
  {
    return ['name' => $this->name, 'content' => $this->content];
  }

  // NbtTag

  public static function createFrom(NbtSource $file): NbtTag
  {
    $self = new static(TAG_String::readFrom($file));
    return static::readFrom($file, $self);
  }

  public function nbtSerialize(): string
  {
    $result = parent::nbtSerialize();
    foreach ($this->store() as $value)
      $result .= $value;

    return $result;
  }

  // ArrayAccess

  public function offsetSet($offset, $value): void
  {
    $value = $this->validate($value);
    if (is_null($offset))
      $this->content[] = $value;
    else
      $this->content[$offset] = $value;
  }

  public function offsetExists($offset): bool
  {
    return isset($this->content[$offset]);
  }

  public function offsetUnset($offset): void
  {
    unset($this->content[$offset]);
  }

  public function offsetGet($offset): mixed
  {
    return isset($this->content[$offset]) ? $this->content[$offset] : null;
  }

  // Countable

  public function count(): int
  {
    return count($this->content);
  }

  // Iterator

  public function current(): mixed
  {
    return $this->valid() ? current($this->content) : null;
  }

  public function key(): mixed
  {
    return key($this->content);
  }

  public function next(): void
  {
    if ($this->valid())
    {
      $this->position++;
      next($this->content);
    }
  }

  public function rewind(): void
  {
    $this->position = 0;
    reset($this->content);
  }

  public function valid(): bool
  {
    return $this->position < count($this->content);
  }

  // JsonSerializable

  public function jsonSerialize(): mixed
  {
    error_log(__METHOD__);
    return [$this->name => $this->content,];
  }

  // Serializable

  public function serialize()
  {
    return serialize(['name' => $this->name, 'content' => $this->content]);
  }

  public function unserialize($blob)
  {
    $data = unserialize($blob);
    $self = new static($data['name'], $data['content']);
    $this->name = $self->name;
    $this->content = $self->content;
  }
}
