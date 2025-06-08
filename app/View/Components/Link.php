<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    private $scheme;
    private $label;
    private $href;
    private $target;
    private $class;
    private $button;

    public function __construct(string $href, string $scheme='base', string $label='', string $target='', string $class='', bool $button=false)
    {
        $this->scheme = $scheme;
        $this->label = $label;
        $this->href = $href;
        $this->target = $target;
        $this->class = $class;
        $this->button = $button;
    }

    public function render(): View|Closure|string
    {

        $args = [
            'scheme' => $this->scheme,
            'label' => $this->label,
            'href' => $this->href,
            'target' => $this->target,
            'class' => $this->class,
            'button' => $this->button,
        ];
        return view('components.form.link-component', $args);
    }
}
