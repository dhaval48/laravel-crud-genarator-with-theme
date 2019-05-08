<nav id="sidebar">
    <ul class="nav flex-column">

        <li class="nav-item admin-dash">
            <div class="row">
                <div class="col-sm-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS95HiQI0ygPVVvedy_X3AwbPGtSNXg98qnhjyjJiSqwlxwVOqK" width="50" class="rounded">
                </div>
                <div class="col-sm-8">
                    <div> {{Auth::user()->name}}</div>
                    <div>
                        Online
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="/home">
                <i class="fa fa-dashboard"></i> Dashboard
            </a>
        </li>

        <li class="seperate-line"></li>
        <h6 class="sidebar-section">ADMIN MODULES</h6>

        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="fa fa-dashboard"></i> User
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="fa fa-dashboard"></i> Roles
            </a>
        </li>
    </ul>
</nav>