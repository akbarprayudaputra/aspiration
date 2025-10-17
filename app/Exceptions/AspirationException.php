<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AspirationException extends Exception
{
  public function __construct(string $message = "", $code = 0)
  {
    parent::__construct($message, $code);
  }

  /**
   * Render the exception as an HTTP response.
   */
  public function render(Request $request)
  {
    return response()->json([
      'message' => $this->getMessage(),
      'code' => $this->getCode(),
    ], $this->getCode() ?: 400);
  }
}
