<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Outokumpu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>

  <nav class="navbar is-white has-shadow">
    <!-- logo / brand -->
    <div class="navbar-brand">
      <a class="navbar-item" href="{{ route('welcome') }}">
        <img src="{{ asset('assets/outokumpu.png') }}" style="max-height: 70px" class="py-2 px-2">
      </a>
      <a class="navbar-burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>

    <div class="navbar-menu" id="nav-links">
      <!-- right links -->
      <div class="navbar-end">
        <a href="{{route('gembas.index')}}" class="navbar-item">Gemba walk</a>
        <a href="{{route('actions.index')}}" class="navbar-item">Action list</a>
        <a href="{{ route('schedules.index') }}"
             class="navbar-item {{ request()->route()->getName() === 'schedules.index' ? "is-active" : "" }}">
              Schedule
        </a>

        <!-- Manager Dashboard Link -->
        @if(Auth::check() && Auth::user()->hasRole('manager'))
            <a href="{{ route('manager.dashboard') }}" class="navbar-item">Manager Dashboard</a>
        @endif

        <!-- Admin Dashboard Link -->
        @if(Auth::check() && Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}" class="navbar-item">Admin Dashboard</a>
        @endif

        <a href="#" class="navbar-item" id="logoutButton">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
      </div>
    </div>
  </nav>

  {{ $slot }}

  <!-- Logout Modal -->
  <div class="modal" id="logoutModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Confirm Logout</p>
        <button class="delete" aria-label="close" id="closeModal"></button>
      </header>
      <section class="modal-card-body">
        Are you sure you want to logout?
      </section>
      <footer class="modal-card-foot">
        <button class="button is-danger" onclick="document.getElementById('logout-form').submit();">Logout</button>
        <button class="button" id="cancelModal">Cancel</button>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2();
    });

    // JavaScript to handle the modal behavior
    document.addEventListener('DOMContentLoaded', () => {
        const logoutButton = document.getElementById('logoutButton');
        const logoutModal = document.getElementById('logoutModal');
        const closeModal = document.getElementById('closeModal');
        const cancelModal = document.getElementById('cancelModal');
        const modalBackground = logoutModal.querySelector('.modal-background');

        logoutButton.addEventListener('click', () => {
            logoutModal.classList.add('is-active');
        });

        closeModal.addEventListener('click', () => {
            logoutModal.classList.remove('is-active');
        });

        cancelModal.addEventListener('click', () => {
            logoutModal.classList.remove('is-active');
        });

        modalBackground.addEventListener('click', () => {
            logoutModal.classList.remove('is-active');
        });
    });
  </script>

  <script src="js/main.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>
