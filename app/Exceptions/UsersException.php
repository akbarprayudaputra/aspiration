<?php

namespace App\Exceptions;

use Exception;

class UsersException extends Exception
{
  /**
   * Report the exception.
   */
  public function __construct($message = "", $code = 0)
  {
    parent::__construct($message, $code);
  }

  /**
   * Render the exception as an HTTP response.
   */
  public function render($request)
  {
    return response()->json([
      'message' => $this->getMessage(),
      'code' => $this->getCode(),
    ], $this->getCode() ?: 400);
  }
}
