<?php

// <ul>
//                 <li><a href="index.html" id="currentpage">Accueil</a></li>
//                 <li><a href="cv.html">CV</a></li>
//                 <li><a href="projets.html">Projets</a></li>
//             </ul>
//         </nav>

function renderMenuToHTML($currentPageId) {
    // 定义菜单结构
    $mymenu = array(
        'index' => array('Accueil'),
        'cv' => array('Cv'),
        'projets' => array('Mes Projets')
    );

    // 生成菜单的 HTML
    echo '<nav class="menu"><ul>';
    foreach($mymenu as $pageId => $pageParameters) {
        echo '<li><a href="' . $pageId . '.php"';
        if ($pageId == $currentPageId) {
            echo ' id="currentpage"';
        }
        echo '>' . $pageParameters[0] . '</a></li>';
    }
    echo '</ul></nav>';
}


