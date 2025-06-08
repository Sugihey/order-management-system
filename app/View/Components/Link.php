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

    public function __construct(string $href, string $scheme='base', string $label='', string $target='', string $class='')
    {
        $this->scheme = $scheme;
        $this->label = $label;
        $this->href = $href;
        $this->target = $target;
        $this->class = $class;
    }

    public function render(): View|Closure|string
    {
        $args = [
            'label' => $this->label,
            'href' => $this->href,
            'target' => $this->target,
            'class' => $this->class,
        ];
        switch($this->scheme){
            case 'scraft':
                return view('components.form.links.scraft-component', $args);
            case 'artisan':
                return view('components.form.links.artisan-component', $args);
            case 'danger':
                return view('components.form.links.danger-component', $args);
            case 'action':
                return view('components.form.links.action-component', $args);
            default:
                return view('components.form.links.base-component', $args);
        }
    }
}
