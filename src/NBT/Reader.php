<?php
/** Minecraft NBT reader class.
*
* @version $Id$
*/

namespace AnrDaemon\Minecraft\NBT;

if(!method_exists('SplFileObject', 'fread'))
  trigger_error('Requires SplFileObject::fread(). Upgrade your PHP.', E_USER_ERROR);

use
  AnrDaemon\Minecraft\Interfaces\NbtSource;

class Reader
implements NbtSource
{
  protected $file;

  public function __construct(\SplFileObject $file)
  {
    $this->file = $file;
  }

  final public function read()
  {
    return Tag::createFrom($this);
  }

  public function fread($length)
  {
    $length = (int)$length;
    if($length < 0)
      throw new \RuntimeException("Backward reads are not supported.");

    if($length)
    {
      $pos = $this->file->ftell();
      $data = $this->file->fread($length);
      if($data === false)
        throw new \RuntimeException("Error while reading from file pointer.");

      if(strlen($data) < $length)
        throw new \UnderflowException("Read " . strlen($data) . " out of {$length} requested bytes from file pointer @{$pos}.");
    }
    else
    {
      $data = '';
    }

    return $data;
  }
}
