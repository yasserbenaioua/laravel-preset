<div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
  <button @click.stop="sidebarOpen = true" class="px-4 ltr:border-r rtl:border-l border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
    <span class="sr-only">Open sidebar</span>
    <svg class="h-6 w-6" x-description="Heroicon name: outline/menu-alt-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
    </svg>
  </button>
  <div class="flex-1 px-4 flex justify-end">
    <div class="ltr:ml-4 rtl:mr-4 flex items-center md:ltr:ml-6 md:rtl:mr-6 space-x-2 rtl:space-x-reverse">
      <!-- Languages dropdown -->
      <div class="relative">
        <x-jet-dropdown :align="LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right'" width="48">
          <x-slot name="trigger">
              <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="sr-only">View Languages</span>
                <svg class="h-6 w-6" x-description="Heroicon name: outline/bell" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                </svg>
              </button>
          </x-slot>

          <x-slot name="content">
            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)              
              <x-jet-dropdown-link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
              </x-jet-dropdown-link>
            @endforeach
          </x-slot>
        </x-jet-dropdown>
      </div>
      <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" x-description="Heroicon name: outline/bell" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
      </button>
      <!-- Profile dropdown -->
      <div class="relative"> 
        <x-jet-dropdown :align="LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right'" width="48">
          <x-slot name="trigger">
              @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                  <button class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                  </button>
              @else
                  <span class="inline-flex rounded-md">
                      <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                          {{ Auth::user()->name }}

                          <svg class="ltr:ml-2 rtl:mr-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                      </button>
                  </span>
              @endif
          </x-slot>

          <x-slot name="content">
              <!-- Account Management -->
              <div class="block px-4 py-2 text-xs text-gray-400">
                  {{ __('Manage Account') }}
              </div>

              <x-jet-dropdown-link href="{{ route('profile.show') }}">
                  {{ __('Profile') }}
              </x-jet-dropdown-link>

              @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                  <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                      {{ __('API Tokens') }}
                  </x-jet-dropdown-link>
              @endif

              <div class="border-t border-gray-100"></div>

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-jet-dropdown-link href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                  this.closest('form').submit();">
                      {{ __('Logout') }}
                  </x-jet-dropdown-link>
              </form>
          </x-slot>
        </x-jet-dropdown>
      </div>
    </div>
  </div>
</div>