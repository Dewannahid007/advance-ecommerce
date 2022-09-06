<?php
use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();

}

function GetTopNavCat(){
    $result=DB::table('categories')
    ->where(['status'=>1])
    ->get();
    $arr=[];
    foreach($result as $row){
        $arr[$row->id] ['city']=$row->category_name;
        $arr[$row->id] ['parent_id']=$row->parent_category_id;
    }
    $str=buildTreeView($arr,0);
    return $str;

} 
$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel=-1){
    global $html;
    foreach($arr as $id=>$data){
          if($parent==$data['parent_id']){
            if($level>$prelevel){
                if($html==''){
                    $html.='<ul class="nav navbar-nav">';
                }else{
                    $html.='<ul class="dropdown-menu">';


                }
            }
            if($level==$prelevel){
                $html.='</li>';
            }
            $html.='<li><a href="#">'.$data['city'].'<span class="caret"></span></a>';
            if($level>$prelevel){
                $prelevel=$level;
            }
            $level++;
            buildTreeView($arr,$id,$level,$prelevel);
            $level--;
          }   
    }
    if($level==$prelevel){
        $html.='</li></ul>';
    }
    return $html;
}

?>