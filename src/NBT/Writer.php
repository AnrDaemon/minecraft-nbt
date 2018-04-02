<?php
/** Minecraft NBT writer class.
*
* @version $Id: Writer.php 280 2018-03-27 16:05:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

if(!method_exists('SplFileObject', 'fwrite'))
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
    return $this->file->fwrite($tag->nbtSerialize());
  }
}
