<?php

namespace AnrDaemon\Minecraft\Interfaces;

interface NbtTag
{
  // Read the tag data from a given source past the tag type/name.
  // The function returns "value tag" - a tag with null name.
  public static function readFrom(NbtSource $file);
  // Create the tag from a given source, starting from the name.
  public static function createFrom(NbtSource $file);
  // Creates an NBT presentation of the tag.
  public function nbtSerialize();
}
