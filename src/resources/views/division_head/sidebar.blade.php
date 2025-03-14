<aside id="sidebar" class="fixed left-0 top-0 w-64 h-full bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-xl transform transition-transform -translate-x-64 md:translate-x-0 z-50">
  <div class="flex items-center justify-between p-6">
      <h2 class="text-2xl font-bold">Culture Monitor</h2>
      <button class="md:hidden text-white focus:outline-none" onclick="toggleSidebar()">
          ✖
      </button>
  </div>
  <nav class="mt-6">
      <ul class="space-y-2">
          <!-- Dashboard Link -->
          <li>
              @if(auth()->user()->role == 'culture_agent')
                  <a href="{{ route('culture.dashboard') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      🏠 <span>Dashboard</span>
                  </a>
              @elseif(auth()->user()->role == 'division_head')
                  <a href="{{ route('division.dashboard') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      🏠 <span>Dashboard</span>
                  </a>
              @elseif(auth()->user()->role == 'admin_hc')
                  <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      🏠 <span>Dashboard</span>
                  </a>
              @endif
          </li>

          <!-- Manage Activities Link -->
          <li>
              @if(auth()->user()->role == 'culture_agent')
                  <a href="{{ route('culture.activities.index') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      📋 <span>Manage Activities</span>
                  </a>
              @elseif(auth()->user()->role == 'division_head')
                  <a href="{{ route('division.activities.index') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      📋 <span>Manage Activities</span>
                  </a>
              @elseif(auth()->user()->role == 'admin_hc')
                  <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      📋 <span>Manage Activities</span>
                  </a>
              @endif
          </li>

          <!-- View Reports Link -->
          <li>
              @if(auth()->user()->role == 'culture_agent')
                  <a href="{{ route('culture.reports.index') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      📊 <span>View Reports</span>
                  </a>
              @elseif(auth()->user()->role == 'division_head')
                  <a href="{{ route('division.reports.index') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      📊 <span>View Reports</span>
                  </a>
              @elseif(auth()->user()->role == 'admin_hc')
                  <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 py-3 px-6 rounded-lg transition hover:bg-indigo-500">
                      📊 <span>View Reports</span>
                  </a>
              @endif
          </li>

          <!-- Logout form -->
          <li>
              <form action="{{ route('logout') }}" method="POST" id="logout-form">
                  @csrf
                  <button type="submit" class="flex items-center gap-3 py-3 px-6 text-red-300 hover:text-white rounded-lg transition hover:bg-red-500 w-full">
                      🚪 <span>Logout</span>
                  </button>                    
              </form>
          </li>
      </ul>
  </nav>
</aside>
