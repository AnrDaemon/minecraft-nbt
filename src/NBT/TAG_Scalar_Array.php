<?php

/** Minecraft NBT TAG_Scalar_Array extension.
 *
 * @version $Id$
 */

namespace AnrDaemon\Minecraft\NBT;

abstract class TAG_Scalar_Array
extends TAG_Array
{
  // TAG_Array

  protected function validate($value)
  {
    if (is_subclass_of($value, __NAMESPACE__ . '\\TAG_Value'))
      $value = $value->value;

    if (!is_scalar($value))
      throw new \InvalidArgumentException("Ivalid scalar value. No null's allowed, too.");

    return $value;
  }
}
