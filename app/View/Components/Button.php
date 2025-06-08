<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    private $scheme;
    private $class;
    private $type;
    private $onClick;
    /**
     * Create a new component instance.
     */
    public function __construct(string $scheme='base', string $type='submit', string $class='', string $onClick='')
    {
        $this->scheme = $scheme;
        $this->type = $type;
        $this->class = !empty($class) ? ' '.$class:'';
        $this->onClick = $onClick;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $args = [
            'type' => $this->type,
            'userClass' => $this->class,
            'onClick' => $this->onClick,
            'scheme' => $this->scheme,
        ];
        return view('components.form.button-component', $args);
    }
}
