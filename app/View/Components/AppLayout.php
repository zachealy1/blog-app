<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view or contents that represent the component.
     *
     * This method returns the view that will be rendered when the `AppLayout` component is used.
     *
     * @return View The view instance for the layout.
     */
    public function render(): View
    {
        // Render the 'layouts.app' view, which serves as the base layout for the application.
        return view('layouts.app');
    }
}
