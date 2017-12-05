<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

use
  ArrayAccess, Countable, Iterator;

abstract class TAG_Array
  extends Tag
  implements
    ArrayAccess,
    Countable,
    Iterator
{
  protected $content;
  protected $position = 0;

  public function __construct($name = null, $content = array())
  {
    \tool::fprint("Creating " . get_called_class() . (count($content) ? " with " . count($content) . " elements" : ''));
    parent::__construct();
    $this->name = $name;
    $this->content = $content ? (array)$content : array();
  }

  public static function createFrom(Reader $file)
  {
    $self = new static(TAG_String::readFrom($file));
    return static::readFrom($file, $self);
  }

  public function __debugInfo()
  {
    return ['name' => $this->name, 'content' => $this->content];
  }

  abstract public static function readFrom(Reader $file, TAG_Array $into = null);

// ArrayAccess

  public function offsetSet($offset, $value)
  {
    if(is_null($offset))
      $this->content[] = $value;
    else
      $this->content[$offset] = $value;
  }

  public function offsetExists($offset)
  {
    return isset($this->content[$offset]);
  }

  public function offsetUnset($offset)
  {
    unset($this->content[$offset]);
  }

  public function offsetGet($offset)
  {
    return isset($this->content[$offset]) ? $this->content[$offset] : null;
  }

// Countable

  public function count()
  {
    return count($this->content);
  }

// Iterator

  public function current()
  {
    return $this->valid() ? current($this->content) : null;
  }

  public function key()
  {
    return $this->valid() ? key($this->content) : null;
  }

  public function next()
  {
    if($this->valid())
    {
      $this->position++;
      return next($this->content);
    }
    return null;
  }

  public function rewind()
  {
    $this->position = 0;
    return reset($this->content);
  }

  public function valid()
  {
    return $this->position < sizeof($this->content);
  }
}
