    <nav id='header' class='navbar navbar-dark bg-dark fixed-top'>
        <div class="container-fluid">
            <h1 id='header-title' class='navbar-brand site-title'>Jinryu<span class='version navbar-text'>ver.α</span></h1>
<?php if ($_SESSION["id"]) { ?>
            <div class='flex margin-right'>
                <p id='header-name' class='navbar-brand users'><?php echo $_SESSION["name"]?> 様</p>
                <form id='header-logout' action="<?php echo $path; ?>login" method="get">
                    <input type="hidden" name="logout" value="logout">
                    <input class='btn btn-secondary logout' type="submit" value="ログアウト">
                </form>
                <button id='header-navbar' class="navbar-toggler navbar-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse nav-main" id="navbarSupportedContent">  
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item nav-logout">
                        <a class="nav-link" style="pointer-events:none;" aria-current="page" href="<?php echo $path; ?>login/?logout=logout">ログアウト</a>
                    </li>
<?php
$items=[['ホーム','/'],['実行履歴','/history/']];
foreach ($items as $item) {
?>
                    <li class="nav-item">
<?php if ($item[1]==$to_path) { ?>
                        <a class="nav-link active" style="pointer-events:none;" aria-current="page" href="<?php echo $path.'.'.$item[1]; ?>"><?php echo $item[0]; ?></a>
<?php } else { ?>
                        <a class="nav-link" aria-current="page" href="<?php echo $path.'.'.$item[1]; ?>"><?php echo $item[0]; ?></a>
<?php } ?>
                    </li>
<?php } ?>
                </ul>
            </div>
<?php } ?>
        </div>
    </nav>
    <div style='height:var(--header_height);'>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        const header = document.getElementById('header');
<?php if ($_SESSION["id"]) { ?>
        const menue = document.getElementById('navbarSupportedContent');
<?php } ?>
        document.documentElement.style.setProperty('--header_height',header.clientHeight<?php if ($_SESSION["id"]) echo '-menue.clientHeight'; ?>+'px');
        window.addEventListener('resize', function() {
            document.documentElement.style.setProperty('--header_height',header.clientHeight<?php if ($_SESSION["id"]) echo '-menue.clientHeight'; ?>+'px');
        }, false );
<?php if ($_SESSION["id"]) { ?>
    const title = document.getElementById('header-title');
    const name = document.getElementById('header-name');
    const logout = document.getElementById('header-logout');
    const navbar = document.getElementById('header-navbar');
    document.documentElement.style.setProperty('--title_width',title.clientWidth +'px');
    document.documentElement.style.setProperty('--name_width',name.clientWidth +'px');
    document.documentElement.style.setProperty('--logout_width',logout.clientWidth +'px');
    document.documentElement.style.setProperty('--navbar_width',navbar.clientWidth +'px');
<?php } ?>
    </script>
