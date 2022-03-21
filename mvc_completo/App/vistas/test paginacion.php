<?php
//include_once('db.php');"
//$query="select id from pagination order by id asc";//ffs: supuestamente funcion que hace la consulta  
//$res = mysqli_query($connection,$query);"
$res =[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26];//query "result"
$count = 26;//ffs:query "result" count
$page = (int) (!isset($_REQUEST['pageId']) ? 1 :$_REQUEST['pageId']);//ffs:llega de js------controlar que no llegue <= 0
//$recordsPerPage = 5;

//$page = ($page == 0 ? 1 : $page);//ffs: why not?
//$start = ($page-1) * $recordsPerPage;//ffs: creacion variable que indica el registro por el que empezar a buscar

$adjacents = "2";

$prev = $page - 1;
$next = $page + 1;
//$lastpage = ceil($count/$recordsPerPage);//ffs: variable indica ultima pagina (+1 if double) como numero entero




?>




<div>
    <div>tabla</div>
    <div id="TEST_ZONE"></div>
</div>
<div>
    <a  onclick="action_decider(this)" id="gotofirst">first</a>
    <a   id="dot_prev">...</a>
    <a  onclick="action_decider(this)" id="num_prev">1</a>
    <a   id="num_this">2</a>
    <a  onclick="action_decider(this)" id="num_next">3</a>
    <a   id="dot_next">...</a>
    <a  onclick="action_decider(this)" id="gotolast">last</a>
</div>









<script>



    var element_per_paige=2 //ffs: or any other number
    var p_actual //ffs: comprobaciones / reload pag btns
    var pmax //ffs: se establece al cargar pagina, ya nos ocuparemos de eso luego
    var p_next //ffs: num nxt
    var p_prev //ffs: num prev
    var p_jump //ffs: mejora para futura version




async function get_paige(gotop,epp) {
    var first_page=document.getElementById("gotofirst")
    var prev_dot=document.getElementById("dot_prev")


    var dis_page=document.getElementById("num_this")
    var nxt_page=document.getElementById("num_next")
    var prv_page=document.getElementById("num_prev")


    var next_dot=document.getElementById("dot_next")
    var last_page=document.getElementById("gotolast")

    
//ffs: aguait llamar phachep y cargarse tabla
    
    
    p_actual=gotop //ffs: watch this out

    pmax=5 //ffs: obtenido del aguait
    if (p_actual <= 1) {
        p_prev="nil" //ffs: controlar esto mejor
        prv_page.innerHTML="nil"


        prev_dot.setAttribute("hidden",true)
        first_page.setAttribute("hidden",true)
        prv_page.setAttribute("hidden",true)
    }else{
        p_prev=p_actual-1
        prv_page.innerHTML=p_prev

        prev_dot.removeAttribute("hidden")
        first_page.removeAttribute("hidden")
        prv_page.removeAttribute("hidden")
    }
    
    if (p_actual >= pmax) {
        p_next="nil" //ffs: controlar esto mejor
        nxt_page.innerHTML="nil"


        next_dot.setAttribute("hidden",true)
        last_page.setAttribute("hidden",true)
        nxt_page.setAttribute("hidden",true)
    }else{
        p_next=p_actual+1
        nxt_page.innerHTML=p_next

        next_dot.removeAttribute("hidden")
        last_page.removeAttribute("hidden")
        nxt_page.removeAttribute("hidden")
    }
    
    
    //console.log(p_actual);
    dis_page.innerHTML=p_actual

    //console.log(p_prev+"-"+p_actual+"-"+p_next)
    
}
get_paige(1,element_per_paige)

function action_decider(dis) {
    


    switch (dis.id) {
        case "gotofirst":
            get_paige(1,element_per_paige)
            break;
        case "gotolast":
            get_paige(pmax,element_per_paige)
        break;
        case "num_prev":
            
            get_paige(p_prev,element_per_paige)
        break;
        case "num_next":
            get_paige(p_next,element_per_paige)
        break;
        

        default:
            break;
    }


}

</script>