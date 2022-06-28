<nav class="navbar">
    <div class="nav-center">
        <div class="nav-header">
            <a href="/" class="nav-logo">
                <img src="public/assets/logo.png" alt="SteamEngine">
            </a>
            <button class="nav-btn btn">
                <i class="fas fa-align-justify"></i>
            </button>
        </div>
        <div class="nav-links">
            <a href="/" class="nav-link"> Home </a>
            <a href="topGames" class="nav-link"> Top games </a>
            <a href="userGames" class="nav-link"> Your games </a>
            <a href="favoriteGames" class="nav-link"> Favorite games </a>
            <div class="nav-link login-link">
                <?
                if(isset($isLogin)){
                        echo '<a href="logout" class="btn"> Logout </a>';
                }
                else{
                    echo '<a href="login" class="btn"> Login </a>';
                }
                ?>



            </div>
        </div>

    </div>
</nav>