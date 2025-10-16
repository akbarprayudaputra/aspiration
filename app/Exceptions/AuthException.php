<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthException extends Exception
{
  /**
   * Render the exception as an HTTP response.
   */

  public function __construct(string $message = "", $code = 0)
  {
    parent::__construct($message, $code);
  }

  public function render(Request $request)
  {
    return response()->json([
      'message' => $this->getMessage(),
      'code' => $this->getCode(),
    ], $this->getCode() ?: 400);
  }
}
