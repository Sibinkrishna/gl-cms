<div class="main-nav">
     @php($adminUser = null)
     @php($vendorUser = auth()->user())
     @php($vendorAccount = $vendorUser ? \Modules\Ecommerce\Models\Vendor::where('user_id', $vendorUser->id)->first() : null)
     @php($adminLogo = \Modules\Settings\Models\Setting::value('admin_logo'))
     @php($logo = $vendorAccount && $vendorAccount->logo ? $vendorAccount->logo : $adminLogo)
     @php($dashboardRoute = $vendorAccount ? 'vendor.dashboard' : 'admin.dashboard')
     @php($hasRoute = static fn (string $name): bool => \Illuminate\Support\Facades\Route::has($name))
     @php($routeUrl = static fn (string $name, mixed $parameters = []): string => $hasRoute($name) ? route($name, $parameters) : 'javascript:void(0);')
     @php($moduleEnabled = static fn (string $name): bool => \App\Support\ModuleRegistry::enabled($name))
     <!-- Sidebar Logo -->
     <div class="logo-box">
          <a href="{{ $routeUrl($dashboardRoute) }}" class="logo-dark">
               <img src="{{ $logo ? asset('storage/' . $logo) : asset('admin/assets/images/logo-sm.png') }}" class="logo-sm" alt="logo sm" style="max-width: 40px; height: auto; object-fit: contain;">
               <img src="{{ $logo ? asset('storage/' . $logo) : asset('admin/assets/images/logo-dark.png') }}" class="logo-lg" alt="logo dark" style="max-width: 170px; height: auto; object-fit: contain;">
          </a>

          <a href="{{ $routeUrl($dashboardRoute) }}" class="logo-light">
               <img src="{{ $logo ? asset('storage/' . $logo) : asset('admin/assets/images/logo-sm.png') }}" class="logo-sm" alt="logo sm" style="max-width: 40px; height: auto; object-fit: contain;">
               <img src="{{ $logo ? asset('storage/' . $logo) : asset('admin/assets/images/logo-light.png') }}" class="logo-lg" alt="logo light" style="max-width: 170px; height: auto; object-fit: contain;">
          </a>
     </div>

     <!-- Menu Toggle Button (sm-hover) -->
     <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
          <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
     </button>

     <div class="scrollbar" data-simplebar>
          <ul class="navbar-nav" id="navbar-nav">

               {{-- <li class="menu-title">General</li> --}}

               @if($adminUser?->can('dashboard.view') && $hasRoute('admin.dashboard'))
                    <li class="nav-item">
                         <a class="nav-link" href="{{ $routeUrl('admin.dashboard') }}">
                              <span class="nav-icon">
                                   <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                              </span>
                              <span class="nav-text"> Dashboard </span>
                         </a>
                    </li>
               @endif

               @if($vendorAccount && request()->routeIs('vendor.*'))
                    @php($vendorMenuOpen = request()->routeIs('vendor.products.*') || request()->routeIs('vendor.orders.*') || request()->routeIs('vendor.dashboard'))
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}" href="{{ $routeUrl('vendor.dashboard') }}">
                              <span class="nav-icon">
                                   <iconify-icon icon="solar:shop-2-bold-duotone"></iconify-icon>
                              </span>
                              <span class="nav-text"> Vendor Dashboard </span>
                         </a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link menu-arrow {{ $vendorMenuOpen ? 'active' : '' }}" href="#sidebarVendorPortal" data-bs-toggle="collapse" role="button" aria-expanded="{{ $vendorMenuOpen ? 'true' : 'false' }}" aria-controls="sidebarVendorPortal">
                              <span class="nav-icon">
                                   <iconify-icon icon="solar:bag-5-bold-duotone"></iconify-icon>
                              </span>
                              <span class="nav-text"> Vendor Portal </span>
                         </a>
                         <div class="collapse {{ $vendorMenuOpen ? 'show' : '' }}" id="sidebarVendorPortal">
                              <ul class="nav sub-navbar-nav">
                                   @if($hasRoute('vendor.products.index'))
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link {{ request()->routeIs('vendor.products.index') ? 'active' : '' }}" href="{{ $routeUrl('vendor.products.index') }}">My Products</a>
                                        </li>
                                   @endif
                                   @if($hasRoute('vendor.products.create'))
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link {{ request()->routeIs('vendor.products.create') ? 'active' : '' }}" href="{{ $routeUrl('vendor.products.create') }}">Add Product</a>
                                        </li>
                                   @endif
                                   @if($hasRoute('vendor.orders.index'))
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link {{ request()->routeIs('vendor.orders.*') ? 'active' : '' }}" href="{{ $routeUrl('vendor.orders.index') }}">Orders</a>
                                        </li>
                                   @endif
                                   @if($hasRoute('vendor.settings.profile') || $hasRoute('vendor.settings.store') || $hasRoute('vendor.settings.bank') || $hasRoute('vendor.settings.notifications'))
                                        <li class="sub-nav-item">
                                             <a class="sub-nav-link menu-arrow {{ request()->routeIs('vendor.settings.*') ? 'active' : '' }}" href="#sidebarVendorSettings" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs('vendor.settings.*') ? 'true' : 'false' }}" aria-controls="sidebarVendorSettings">
                                                  Settings
                                             </a>
                                             <div class="collapse {{ request()->routeIs('vendor.settings.*') ? 'show' : '' }}" id="sidebarVendorSettings">
                                                  <ul class="nav sub-navbar-nav">
                                                       @if($hasRoute('vendor.settings.profile'))
                                                            <li class="sub-nav-item">
                                                                 <a class="sub-nav-link {{ request()->routeIs('vendor.settings.profile') ? 'active' : '' }}" href="{{ $routeUrl('vendor.settings.profile') }}">Profile</a>
                                                            </li>
                                                       @endif
                                                       @if($hasRoute('vendor.settings.store'))
                                                            <li class="sub-nav-item">
                                                                 <a class="sub-nav-link {{ request()->routeIs('vendor.settings.store') ? 'active' : '' }}" href="{{ $routeUrl('vendor.settings.store') }}">Store</a>
                                                            </li>
                                                       @endif
                                                       @if($hasRoute('vendor.settings.bank'))
                                                            <li class="sub-nav-item">
                                                                 <a class="sub-nav-link {{ request()->routeIs('vendor.settings.bank') ? 'active' : '' }}" href="{{ $routeUrl('vendor.settings.bank') }}">Bank</a>
                                                            </li>
                                                       @endif
                                                       @if($hasRoute('vendor.settings.notifications'))
                                                            <li class="sub-nav-item">
                                                                 <a class="sub-nav-link {{ request()->routeIs('vendor.settings.notifications') ? 'active' : '' }}" href="{{ $routeUrl('vendor.settings.notifications') }}">Notifications</a>
                                                            </li>
                                                       @endif
                                                  </ul>
                                             </div>
                                        </li>
                                   @endif
                              </ul>
                         </div>
                    </li>
               @endif
          </ul>
     </div>
</div>
