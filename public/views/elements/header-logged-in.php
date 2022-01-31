<script type="text/javascript" src="/public/js/index.js" defer></script>
<script type="text/javascript" src="/public/js/header.js" defer></script>

<header>
    <button id="mobile-header-btn" onclick="headerButtonHandler();" class="mobile-header-btn">☰</button>
        <div class="header-item">
            <a href="/dashboard"><img src="public/img/logo_text.svg" alt="Workager logo" id="logo"></a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/plans">Plans</a>
        </div>
        <div class="header-item header-item-btn">
            <a href="/workouts">Workouts</a>
        </div>
        <div class="header-item header-item-btn">
            <button class="profile-icon">
                <img src="/public/img/profile-picture.png" alt="profile-button">
            </button>
            <nav id="profile-overlay">
                <ul>
                    <li>
                        <a href="/settings">Settings</a>
                    </li>
                    <li>
                        <form method="POST" action="logout">
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
</header>
