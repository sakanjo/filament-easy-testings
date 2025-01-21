<?php

namespace SaKanjo\FilamentEasyTestings\Concerns;

use Closure;

trait HasVisibility
{
    protected Closure|bool $isVisible = true;

    public function visible(Closure|bool $condition): static
    {
        $this->isVisible = $condition;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->evaluate($this->isVisible);
    }
}
