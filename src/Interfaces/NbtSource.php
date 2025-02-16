<?php

namespace AnrDaemon\Minecraft\Interfaces;

interface NbtSource
{
  /** The byte stream provider
   *
   * @param int $len Bytes count to read.
   * @return string
   */
  public function fread(int $len): string;
}
