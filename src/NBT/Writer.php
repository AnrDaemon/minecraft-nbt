<?php
/** Minecraft NBT writer class.
*
*
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

if(version_compare(PHP_VERSION, '5.1', '<'))
  trigger_error('Requires SplFileObject::fwrite(). Upgrade your PHP.', E_USER_ERROR);

class Writer
{
  protected $file;

  public function __construct(\SplFileObject $file)
  {
    $this->file = $file;
  }

  public function __destruct()
  {
    $this->file->fflush();
    unset($this->file);
  }

  public function write(Tag $tag)
  {
    return $tag->save($this->file);
  }

// pack() wrapper, because damned "machine byte order"
  final public static function convert($format, $value)
  {
    return Dictionary::convert(pack($format, $value));
  }
}
