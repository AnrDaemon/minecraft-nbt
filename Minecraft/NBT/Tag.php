<?php
/** Minecraft NBT Tag base class.
*
* @version $Id: Tag.php 187 2016-07-19 19:25:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

use
  JsonSerializable, Serializable, SplFileObject;

// Plug the built-in debug logging.
if(!class_exists('\tool', false)) { final class tool { static function __callStatic($name, $args) {} } }

abstract class Tag
  implements Serializable, JsonSerializable
{
  protected $id;
  public $name = null;

  public function __construct()
  {
    $this->id = get_called_class();
  }

  public function save(SplFileObject $file)
  {
    \tool::fprint("Saving ... " . get_called_class() . (isset($this->name) ? ":{$this->name}" : '') . "@{$file->ftell()}");

    return $file->fwrite(isset($this->name) ? Dictionary::mapName($this->id) . TAG_String::store($this->name) : '');
  }

  abstract public function __debugInfo();

// JsonSerializable
  abstract public function jsonSerialize();

// Serializable
  abstract public function serialize();
  abstract public function unserialize($blob);
}
