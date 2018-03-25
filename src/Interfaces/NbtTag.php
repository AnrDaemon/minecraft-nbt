<?php

namespace AnrDaemon\Minecraft\Interfaces;

use
  AnrDaemon\Minecraft\NBT\Reader;

interface NbtTag
{
  public static function readFrom(Reader $file);
  public static function createFrom(Reader $file);
  public function save(\SplFileObject $file);
}
