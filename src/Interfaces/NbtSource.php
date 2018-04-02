<?php

namespace AnrDaemon\Minecraft\Interfaces;

interface NbtSource
{
  // The byte stream provider.
  public function fread($len);
}
