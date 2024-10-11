<?php
function renderMenuToHTML($currentPageId) {
    // 定义菜单项
    $mymenu = array(
        'index' => array('Accueil'),
        'cv' => array('CV'),
        'projets' => array('Mes Projets')
    );

    // 输出菜单的 HTML
    echo '<nav class="menu"><ul>';
    
    // 遍历菜单数组，生成菜单项
    foreach ($mymenu as $pageId => $pageParameters) {
        echo '<li><a href="' . $pageId . '.php"';
        
        // 为当前页面加上 id="currentpage"
        if ($pageId == $currentPageId) {
            echo ' id="currentpage"';
        }
        
        // 菜单项文字
        echo '>' . $pageParameters[0] . '</a></li>';
    }
    
    echo '</ul></nav>';
}
?>

