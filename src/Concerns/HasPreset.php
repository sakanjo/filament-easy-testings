<?php

namespace SaKanjo\FilamentEasyTestings\Concerns;

use Closure;
use SaKanjo\FilamentEasyTestings\Presets\DefaultPreset;
use SaKanjo\FilamentEasyTestings\Presets\Preset;

trait HasPreset
{
    protected Preset|Closure|null $preset = null;

    public function preset(Preset|Closure $preset): static
    {
        $this->preset = $preset;

        return $this;
    }

    public function getPreset(): Preset
    {
        return $this->evaluate($this->preset) ?? DefaultPreset::make();
    }
}
