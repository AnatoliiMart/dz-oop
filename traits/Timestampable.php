<?php

namespace Traits;

trait Timestampable
{
  private int $created_at;
  private int $updated_at;
  public function getCreatedAt(): int
  {
    return $this->created_at;
  }
  public function getUpdatedAt(): int
  {
    return $this->updated_at;
  }
  public function setCreatedAt(int $timestamp)
  {
    $this->created_at = $timestamp;
  }
  public function setUpdatedAt(int $timestamp)
  {
    $this->updated_at = $timestamp;
  }
}
