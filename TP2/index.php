<?php
    require_once("template_header.php");

    require_once("template_menu.php");
    renderMenuToHTML('index');
?>
</nav>
        
        <!-- <ul>
                <li><a href="index.html" id="currentpage">Accueil</a></li>
                <li><a href="cv.html">CV</a></li>
                <li><a href="projets.html">Projets</a></li>
            </ul>
        </nav> -->

        <!-- 页面内容 -->
        <div class="content">
            <h1>Bienvenue sur ma page d'accueil</h1>
            <p>Bonjour, bienvenue sur mon site web. C'est le premier site que j'ai créé. Je vous souhaite de passer une agréable journée.</p>
        </div>

        <div class="image-center">
            <img src="R.jpg" alt="Center Image">
        </div>
<?php
    require_once("template_footer.php");
?>