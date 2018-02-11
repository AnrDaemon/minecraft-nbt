<?php
/** Minecraft NBT Tag base class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

abstract class TAG_Value
extends Tag
{
  public $value = null;

  public function __construct($name = null, $value = null)
  {
    \tool::fprint("Creating " . get_called_class() . ":$name(" . (is_a($value, __CLASS__) ? $value->value : $value) . ")");
    parent::__construct();
    $this->name = $name;
    $this->value = is_a($value, __CLASS__) ? $value->value : $value;
  }

  public static function createFrom(Reader $file)
  {
    \tool::fprint("Reading ... " . get_called_class() . "::" . __FUNCTION__);
    return new static(TAG_String::readFrom($file), static::readFrom($file));
  }

  public function save(\SplFileObject $file)
  {
    return parent::save($file) + $file->fwrite(static::store($this->value));
  }

  public function __debugInfo()
  {
    return ['name' => $this->name, 'value' => $this->value];
  }

  abstract public static function store($value);
  abstract public function __toString();
}
