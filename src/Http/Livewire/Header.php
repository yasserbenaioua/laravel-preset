<?php

namespace Benaioua\MyPreset\Http\Livewire;

use Livewire\Component;

class Header extends Component
{
  /**
   * The component's listeners.
   *
   * @var array
   */
  protected $listeners = [
    'refresh-navigation-menu' => '$refresh',
  ];

  /**
   * Render the component.
   *
   * @return \Illuminate\View\View
   */
  public function render()
  {
    return view('header');
  }
}
