<?php

/** Minecraft NBT compressed writer class.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

class CompressedWriter
extends Writer
{
  public function write(Tag $tag): int
  {
    return $this->file->fwrite(gzencode($tag->nbtSerialize(), 9, FORCE_GZIP));
  }
}
