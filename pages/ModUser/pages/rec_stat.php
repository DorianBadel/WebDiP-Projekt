<?php
  $requireLogin =true;
  $minStatus = 3;
  include "../../../globals/global.php"
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
   <title>Statistika o autorima</title>

   <link rel="stylesheet" href="../../../index.css">


   <!--Globals-->
   <script src="../../../globals/template.js" type="text/javascript"></script>
   <link rel="stylesheet" href="../../../globals/template.css">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>

   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>


   <script src="script/read_xml.js" ></script>
 </head>
 <body>

   <header id="header">
     <div class="sidebar">
     <div class="logo-details">
         <a href="../../../index.php">
              <i class='bx bxs-news' id='btn'></i>
         </a>
     </div>
     <ul class="nav-list">
       <li class="profile">
         <div class="profile-details">
           <?php
             session_start();
             if(empty($_SESSION['username'])){
               echo "<a href='prijava.php'><i class='bx bx-log-in' id='log_out'></i></a>";
             }
             else{
               echo "<a href='../../../globals/logout.php'><i class='bx bx-log-out' id='log_out'></i></a>";
             }
           ?>

         </div>
       </li>

      </ul>
    </div>


   </header>
   <section class='body'>

     <div id="popup" class="popup">
       <?php
       if(empty($_SESSION['username'])){
         if(!isset($_COOKIE['uvjeti'])){
           echo "
           <script>
             var pu = document.getElementById('popup');
             pu.style.display = 'inherit';
           </script>";

           require_once('../../../globals/smarty/smarty_main.php');
           include '../../../globals/global.php';
           $dataB = new DB();

           $sql_uvjeti = $dataB->query("SELECT * FROM uvjeti_koristenja");

           $opcije = array();
           $i = 0;
           foreach($sql_uvjeti as &$row){
             $opcije[] = $row["opis_uvjeta"];
             $smarty->assign('opcije',$opcije);
             $i++;
           }
           $smarty->display("../../../globals/smarty/components/index.tpl");
         } else{
           echo "
           <script>
             var pu = document.getElementById('popup');
             pu.style.display = 'none';
           </script>";
         }}else{
           echo "
           <script>
             var pu = document.getElementById('popup');
             pu.style.display = 'none';
           </script>";
         }
        ?>

     </div>

     <div class="section_header">
       <h1>Statistika o autorima</h1>
     </div>
     </div>
     <div class="section_body" >

       <div class="graph" style="display: flex; justify-content: space-around; padding-bottom: 60px">
         <canvas id="canvas" width="600" height="400"></canvas>
       </div>

       <div class="section__blokiran">
         <table id="java_table" style="text-align: center">
           <thead>
             <tr>
               <!-- HEADER -->
               <th>Korisnik</th>
               <th>Broj prihvacenih vijesti</th>
               <th>Broj odbijenih vj</th>
             </tr> <!-- HEADER -->
           </thead>

           <tbody id="java_tbody">

           </tbody>

           <tfoot>
             <tr>
               <td></td>
               <td></td>
               <td></td>
             </tr>
           </tfoot>

         </table>


       </div>
     </div>
     <!-- If user has no JS -->
     <noscript>Sorry, your browser does not support JavaScript!</noscript>
   </section>
   <footer id="footer">
   </footer>
 </body>
 </html>
