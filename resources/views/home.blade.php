@extends('layouts.layout')

@section('content')

@if (Auth::user()->isFirstTime == true )
    <change-password></change-password>
@endif
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <router-link class="navbar-brand brand-logo" to="/admin" style="width: 380px: height: 80px">
            <img id="firstLogo" src="assets/img/evapro3.png" alt="logo" />
          </router-link>
          <router-link class="navbar-brand brand-logo-mini" to="/admin">
            <img id="secondLogo" src="assets/img/evapro_favicon.png" alt="logo" />
          </router-link>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text" id="welcome-text-night" style="display: none">Bonne soirée, <span class="text-black fw-bold" id="nameAuth">{{ Auth::user()->full_name }}</span></h1>
            <h1 class="welcome-text" id="welcome-text-morning" style="display: none">Bonne journée, <span class="text-black fw-bold" id="nameAuth">{{ Auth::user()->full_name }}</span></h1>
            <h1 class="welcome-text" id="welcome-text-evening" style="display: none">Bonne soirée, <span class="text-black fw-bold" id="nameAuth">{{ Auth::user()->full_name }}</span></h1>
            <h1 class="welcome-text" id="welcome-text-afternoon" style="display: none">Bon après-midi, <span class="text-black fw-bold" id="nameAuth">{{ Auth::user()->full_name }}</span></h1>

            <h3 class="welcome-sub-text">Votre résumé des statistiques cette année</h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          {{-- <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown">
              <i class="icon-mail icon-lg"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
              </div>

          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon-bell"></i>
                <span class="count"></span>
            </a>
            <notifications-user></notifications-user>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src={{'assets/images/' . Auth::user()->image}} width='40px' height='40px' alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src={{'assets/images/' . Auth::user()->image}} width='40px' height='40px' alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->full_name }}</p>
                <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
              <router-link class="dropdown-item" to="/myprofil"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mon profil </router-link>
              <a class="dropdown-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Se déconnecter</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">Thème</p>
          <div class="sidebar-bg-options selected" style="cursor: pointer" onclick="
          let url = '{{ asset('assets/template/css/vertical-layout-light/style.css')}}';
            $('#theme').attr('href', url);
            $('.text-white').addClass('text-black');
            $('.text-white').removeClass('text-white');
            $('#firstLogo').attr('src', 'assets/img/evapro3.png');
            $('#secondLogo').attr('src', 'assets/img/evapro_favicon.png');

            ">
          <div class="img-ss rounded-circle bg-light border me-3"></div>Clair</div>
          <div class="sidebar-bg-options" style="cursor: pointer"
          onclick="
          let url = '{{ asset('assets/template/css/vertical-layout-dark/style.css')}}';
            $('#theme').attr('href', url);
            $('.text-black').addClass('text-white');
            $('.text-black').removeClass('text-black');
            $('#firstLogo').attr('src', 'assets/img/logo_clair.png');
            $('#secondLogo').attr('src', 'assets/img/evapro_favicon_clair.png');

            ">
          <div class="img-ss rounded-circle bg-dark border me-3"></div>Sombre</div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary me-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          {{-- <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div> --}}
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <router-link class="nav-link" to="/home">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Tableau de bord</span>
            </router-link>
          </li>
          <li class="nav-item nav-category">MES SERVICES</li>
          <li class="nav-item">
            <router-link  class="nav-link" to="/myprojects">
                <i class="menu-icon mdi mdi-flask-outline"></i>
              <span class="menu-title">Mes projets</span>
            </router-link >
          </li>
          <li class="nav-item">
            <router-link  class="nav-link" to="/myexpenses">
                <i class="menu-icon mdi mdi-percent"></i>
              <span class="menu-title">Mes dépenses</span>
            </router-link >
          </li>
          <li class="nav-item">
            <router-link  class="nav-link" to="/mybillings">
                <i class="menu-icon mdi mdi-file-outline"></i>
              <span class="menu-title">Mes factures</span>
            </router-link >
          </li>
          <li class="nav-item">
            <router-link  class="nav-link" to="/reportwork">
              <i class="menu-icon mdi mdi-timetable"></i>
              <span class="menu-title">CRA</span>
            </router-link >
          </li>
          <li class="nav-item nav-category">Aide</li>
          <li class="nav-item">
            <a class="nav-link" href="/documentation.pdf">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <router-view></router-view>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. Tous les droits sont réservés.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>

</div>

@endsection
