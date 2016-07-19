<?php
/** Minecraft NBT writer class.
*
*
*
* @version $Id: Writer.php 177 2016-07-17 23:33:03Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

if(version_compare(PHP_VERSION, '5.1', '<'))
  die('Needs SplFileObject::fwrite(). Upgrade your PHP.');

use
  SplFileObject;

class Writer
{
  protected $file;

  public function __construct(SplFileObject $file)
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
    \tool::fprint("Writing ... " . get_called_class() . "@{$this->file->ftell()}");
    return $tag->save($this->file);
  }

// pack() wrapper, because damned "machine byte order"
  final public static function convert($format, $value)
  {
    return Dictionary::convert(pack($format, $value));
  }
}
