<?php
/** Minecraft NBT compressed writer class.
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
    $tmp = new \SplFileObject('php://temp', 'wb+');
    $tag->save($tmp);
    $pos = $tmp->ftell();
    $tmp->fseek(0);
    return $this->file->fwrite(gzencode($tmp->fread($pos), 9, FORCE_GZIP));
  }
}
