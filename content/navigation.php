<style type="text/css">
    #loading-icon-bx {
        background-image: url('assets/images/4.png');
        background-size: 200px !important;
        height: 100px; /* Adjust based on your loading icon */
        width: 100%; /* Make it full width */
        background-repeat: no-repeat;
        background-position: center;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .menu-logo img {
        max-width: 100%;
        height: auto;
    }

    .navbar-toggler {
        border: none;
    }

    .nav-search-bar input {
        width: 100%;
        max-width: 200px; /* Limit max width */
    }

    .nav-social-link a {
        display: inline-block;
        margin-left: 10px;
    }

    /* Media Queries for responsiveness */
    @media (max-width: 768px) {
        .menu-links {
            flex-direction: column; /* Stack items */
            width: 100%;
        }

        .nav-search-bar {
            width: 100%;
            text-align: center;
        }

        .navbar-toggler {
            display: block;
        }
    }

    @media (min-width: 769px) {
        .navbar-collapse {
            display: flex !important; /* Show menu on larger screens */
        }

        .nav-search-bar {
            display: block;
        }
    }
</style>

<div id="loading-icon-bx"></div>

<!-- Header Top ==== -->
<header class="header rs-nav">
    <div class="sticky-header navbar-expand-lg">
        <div class="menu-bar clearfix">
            <div class="container clearfix">
                <!-- Header Logo ==== -->
                <div class="menu-logo">
                    <a href="index"><img src="assets/images/3.png" alt=""></a>
                </div>
                <!-- Mobile Nav Button ==== -->
                <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Author Nav ==== -->
                <div class="secondary-menu">
                    <div class="secondary-inner">
                        <a href="residents.php" style="color: black;">LOGIN</a>
                    </div>
                </div>
                <!-- Search Box ==== -->
                
                <!-- Navigation Menu ==== -->
                <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
                    <div class="menu-logo">
                        <a href="index.html"><img src="assets/images/3.png" alt=""></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="index">Home</a></li>
                        <li><a href="all-announcements">Announcements</a></li>
                        <li><a href="officials">Officials</a></li>
                        <li><a href="services">Documents</a></li>
                        <li><a href="contact">Contact</a></li>
                        <li><a href="about-us">About Us</a></li>
                        <li><a href="calendar">Calendar</a></li>
                    </ul>
                    <div class="nav-social-link">
                        <!-- <a href="residents">Login</a> -->
                    </div>
                </div>
                <!-- Navigation Menu END ==== -->
            </div>
        </div>
    </div>
</header>
<!-- header END ==== -->
