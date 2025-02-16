<?php

namespace AnrDaemon\Minecraft\Interfaces;

use AnrDaemon\Minecraft\NBT\Tag;

interface NbtTag
{
  /** Read the tag data from a given source past the tag type/name
   *
   * The function returns "value tag" - a tag with null name.
   *
   * @param NbtSource $file
   * @return Tag
   */
  public static function readFrom(NbtSource $file): NbtTag;

  /** Create the tag from a given source, starting from the name
   *
   * @param NbtSource $file
   * @return Tag
   */
  public static function createFrom(NbtSource $file): NbtTag;

  /** Creates an NBT presentation of the tag
   *
   * @return string
   */
  public function nbtSerialize(): string;
}
