<?php

    function PageNavigation($page){
       include 'DatabaseOperation.php';
       $TotalCount =GetProductsCount();
       $TotalPage = $TotalCount / 20;


       if($page < $TotalPage && $page != 1){
           echo'
           <li class="page-item ">
           <a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1"><b>Previous</b></a>
           </li>';
           echo'
           <li class="page-item"><a class="page-link" href="shop.php?page='.($page-1).'"><b>'.($page-1).'</b></a></li>
           <li class="page-item"><a class="page-link" href="shop.php?page='.$page.'"><b>'.$page.'</b></a></li>
           <li class="page-item"><a class="page-link" href="shop.php?page='.($page+1).'"><b>'.($page+1).'</b></a></li>
           <li class="page-item">
           ';
           echo'
               <li class="page-item">
               <a class="page-link" href="shop.php?page='.($page+1).'" ><b>Next</b></a>
               </li>
           ';
       }else if($page == 1){
           echo'
           <li class="page-item disabled">
           <a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1" disabled><b>Previous</b></a>
           </li>';
           echo'
           <li class="page-item"><a class="page-link" href="shop.php?page=1"><b>1</b></a></li>
           <li class="page-item"><a class="page-link" href="shop.php?page='.($page+1).'"><b>'.($page+1).'</b></a></li>
           <li class="page-item"><a class="page-link" href="shop.php?page='.($page+2).'"><b>'.($page+2).'</b></a></li>
           <li class="page-item">
           ';
           echo'
           <li class="page-item">
           <a class="page-link" href="shop.php?page='.($page+1).'" ><b>Next</b></a>
           </li>
       ';
       }else if($page == $TotalPage){
           echo'
           <li class="page-item ">
           <a class="page-link" href="shop.php?page='.($page-1).'" tabindex="-1"><b>Previous</b></a>
           </li>';
           echo'
           <li class="page-item"><a class="page-link" href="shop.php?page=1"><b>1</b></a></li>
           <li class="page-item"><a class="page-link" href="shop.php?page='.($page+1).'"><b>'.($page+1).'</b></a></li>
           <li class="page-item"><a class="page-link" href="shop.php?page='.($page+2).'"><b>'.($page+2).'</b></a></li>
           ';
           echo'
           <li class="page-item disabled">
           <a class="page-link" href="shop.php?page='.($page+1).'" disabled><b>Next</b></a>
           </li>
       ';
       }

    }

    PageNavigation(1);
                 
?>