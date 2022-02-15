 <div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
                <div class="container-fluid">
                    <!-- LOGO -->
                    <a href="index.html" class="navbar-brand mr-0 mr-md-2 logo">
                        <span class="logo-lg">
                            <img src="<?php echo base_url() ?>assets/admin/images/logo.png" alt="" height="24" />
                            <span class="d-inline h5 ml-1 text-logo">GSL</span>
                        </span>
                        <span class="logo-sm">
                            <img src="<?php echo base_url() ?>assets/admin/images/logo.png" alt="" height="24">
                        </span>
                    </a>

                    <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
                        <li class="">
                            <button class="button-menu-mobile open-left disable-btn">
                                <i data-feather="menu" class="menu-icon"></i>
                                <i data-feather="x" class="close-icon"></i>
                            </button>
                        </li>
                    </ul>

                    <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
                     
                        <li class="dropdown notification-list" >
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <i data-feather="user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-md">

                                <div class="slimscroll noti-scroll">

									<a href="<?php echo site_url('Admin/UpdatePassword') ?>" class="dropdown-item notify-item">
										<i data-feather="settings" class="icon-dual icon-xs mr-2"></i>
										<span>Settings</span>
									</a>

									<div class="dropdown-divider"><hr></div>

									<a href="<?php echo site_url('admin/logout') ?>" class="dropdown-item notify-item">
										<i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
										<span>Logout</span>
									</a>
                                </div>
                  
                               
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
           