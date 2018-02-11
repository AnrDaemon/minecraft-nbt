<?php
/** Minecraft NBT writer class.
*
*
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

class CompressedWriter
extends Writer
{
  public function write(Tag $tag)
  {
    \tool::fprint("Writing ... " . get_called_class() . "@{$this->file->ftell()}");
    $tmp = new \SplFileObject('php://memory', 'wb+');
    $tag->save($tmp);
    $pos = $tmp->ftell();
    $tmp->fseek(0);
    return $this->file->fwrite(gzencode($tmp->fread($pos), 9, FORCE_GZIP));
  }
}
