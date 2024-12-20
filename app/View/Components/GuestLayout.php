<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view or contents that represent the component.
     *
     * This method specifies the layout view to be rendered when the `GuestLayout` component is used.
     *
     * @return View The view instance for the guest layout.
     */
    public function render(): View
    {
        // Render the 'layouts.guest' view, which serves as the layout for guest users.
        return view('layouts.guest');
    }
}
