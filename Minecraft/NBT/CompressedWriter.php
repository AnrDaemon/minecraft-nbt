<?php
/** Minecraft NBT writer class.
*
*
*
* @version $Id: CompressedWriter.php 177 2016-07-17 23:33:03Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

if(version_compare(PHP_VERSION, '5.1', '<'))
  die('Needs SplFileObject::fwrite(). Upgrade your PHP.');

use
  SplFileObject;

class CompressedWriter extends Writer
{
  public function write(Tag $tag)
  {
    \tool::fprint("Writing ... " . get_called_class() . "@{$this->file->ftell()}");
    $tmp = new SplFileObject('php://memory', 'wb+');
    $tag->save($tmp);
    $pos = $tmp->ftell();
    $tmp->fseek(0);
    return $this->file->fwrite(gzencode($tmp->fread($pos), 9, FORCE_GZIP));
  }
}
