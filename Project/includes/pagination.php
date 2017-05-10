<?php


?>
<!-- Навигация по страниците -->
<div class="text-center">
    <ul class="pagination pagination-sm">
    
        <!-- Първа страница-->
        <li class="page-item <?= ($page == 1) ? 'disabled' : '';?>">
            <a class="page-link"<?php
                if($page == 1) {
                    echo '';
                } else { 
                    echo 'href="' . $self . '?';
                    echo (!$sort == 1) ? '' : "sort=$sort&";
                    echo ($type == null) ? '' : "type=$type";
                    echo '"';
                }
                ?>>Първа
            </a>
        </li>
        
        <!-- Предишна страница-->
        <li class="page-item <?= ($page == 1) ? 'disabled' : '';?>">
            <a class="page-link"<?php
                if($page == 1){ 
                    echo '';
                } else { 
                    echo 'href="' . $self;
                    echo (($page > 2) and ($page <= $lastPage)) ? '?page='.($page-1) : ''; 
                    echo $page == 2 ? '?' : '';
                    echo (!$sort == 1) ? '' : "&sort=$sort";
                    echo ($type == null) ? '' : "&type=$type";
                    echo '"';
                }
                ?>>Предишна
            </a>
        </li>
        
        <!-- Текуща страница-->
        <li class="page-item"><span>Страница <?= $page . ' от ' . $lastPage; ?> </span></li>
        
        <!-- Следваща страница-->
        <li class="page-item <?=($page == $lastPage) ? 'disabled' : '';?>">
            <a class="page-link"<?php
                if($page == $lastPage){ 
                    echo '';
                } else { 
                    echo 'href="' . $self;
                    echo '?page=' . ((($page>=1) and ($page<$lastPage)) ? ($page+1) : $lastPage);
                    echo (!$sort == 1) ? '' : "&sort=$sort";
                    echo ($type == null) ? '' : "&type=$type";
                    echo '"';
                }
                ?>>Следваща
            </a>
        </li>
        
        <!-- Последна страница -->
        <li class="page-item <?= ($page == $lastPage) ? 'disabled' : '';?>">
            <a class="page-link"<?php
                if($page == $lastPage){ 
                    echo '';
                } else { 
                    echo 'href="' . $self . '?page=';
                    echo $lastPage;
                    echo (!$sort==1) ? '' : "&sort=$sort";
                    echo ($type==null) ? '' : "&type=$type";
                    echo '"';
                }
                ?>>Последна
            </a>
        </li>
        
    </ul>
</div>