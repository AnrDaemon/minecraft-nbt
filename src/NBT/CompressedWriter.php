<?php
/** Minecraft NBT compressed writer class.
*
*
*
* @version $Id: CompressedWriter.php 280 2018-03-27 16:05:51Z anrdaemon $
*/

namespace AnrDaemon\Minecraft\NBT;

class CompressedWriter
extends Writer
{
  public function write(Tag $tag)
  {
    return $this->file->fwrite(gzencode($tag->nbtSerialize(), 9, FORCE_GZIP));
  }
}
