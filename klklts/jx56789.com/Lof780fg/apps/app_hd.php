<?php
require_once '../../include/common.inc.php';
require_once '../function.php';
if(stripos(auth_group($_SESSION['login_gid']),'apps_hd')===false)exit("没有权限！");
switch($act){
	case "hd_del":
		hd_del(implode(',',$ids));
	break;
}

if(!isset($choice_roomid)){
       if(empty($login_roomid)){
 $choice_roomid=$default_roomid;
    }else{
     $choice_roomid=$login_roomid;
}
  }
$room_list_li = room_list_li($choice_roomid);
?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
<!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
<link href="../assets/css/prettify.css" rel="stylesheet" type="text/css" />
<style type="text/css">
code { padding: 0px 4px; color: #d14; background-color: #f7f7f9; border: 1px solid #e1e1e8; }
</style>
<script>
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}
function ftime(time){
    if (time!=undefined && time!=0){
	return new Date(time*1000).Format("yyyy-MM-dd hh:mm"); }else{return '';}
}
</script>
</head>
<body>
<div class="container"  style=" min-width:1300px;">
<form  class="form-horizontal" action="" method="get"> 
  <ul class="breadcrumb"><button type="button" class="button button-success" id="add_group_bt" style="float: right" onClick="openAppHd(0,'add',<?=$choice_roomid?>)">添加</button>
    <li class="active">
     <button type="button" class="button button-info"  onclick="hd_trueinfo()">喊单正确率</button>&nbsp;&nbsp;&nbsp;&nbsp;
      <span style="color: #F90">选择房间：</span> <select name="choiceroom" id="choiceroom" OnChange="choice_room(this.value)">   
                       <?=$room_list_li;?>  
                     </select> &nbsp;&nbsp;&nbsp;&nbsp;
    关键字：
      <input type="text" name="key" id="key"class="abc input-default" placeholder=""> 
      &nbsp;&nbsp;
        <input type="hidden" name="choice_roomid" value="<?=$choice_roomid?>">
      <button type="submit"  class="button ">查询</button>
      <button type="button"  class="button  button-danger"  onClick="if(confirm('确定删除？'))$('#hd_list').submit()">删除所选</button>
    &nbsp;&nbsp;</li>
   
  </ul>
  </form>
  <form action="" method="POST" enctype="application/x-www-form-urlencoded"  class="form-horizontal" id="hd_list"><input type="hidden" name="act" value="hd_del"> 
  <table  class="table table-bordered table-hover definewidth m10">
    <thead>
      <tr style="font-weight:bold" class="m-table-th-bg">
        <td width="30" align="center" bgcolor="#FFFFFF">编号</td>
        <td width="19" align="center" bgcolor="#FFFFFF"><input type="checkbox" onClick="$('.ids').attr('checked',this.checked); "></td>
        <td  align="center" bgcolor="#FFFFFF">开仓时间</td>
        <td  align="center" bgcolor="#FFFFFF">类型</td>
        <td  align="center" bgcolor="#FFFFFF">仓位</td>
        <td  align="center" bgcolor="#FFFFFF">商品</td>
        <td align="center" bgcolor="#FFFFFF">开仓价</td>
        <td align="center" bgcolor="#FFFFFF">止损价</td>
        <td align="center" bgcolor="#FFFFFF">止盈价</td>
        <td align="center" bgcolor="#FFFFFF">平仓时间</td>
        <td align="center" bgcolor="#FFFFFF">平仓价</td>
		<td align="center" bgcolor="#FFFFFF">盈利点</td>
        <td align="center" bgcolor="#FFFFFF">备注</td>
        <td align="center" bgcolor="#FFFFFF">赞</td>
        <td align="center" bgcolor="#FFFFFF">分析师</td>
        <td width="120" align="center" bgcolor="#FFFFFF">操作</td>
      </tr>
      
    </thead>
    
<?php
echo app_hd_list(20,$choice_roomid,$key,'
    <tr>
      <td align="center" bgcolor="#FFFFFF">{id}</td>
      <td align="center" bgcolor="#FFFFFF"><input type="checkbox" class="ids" name="ids[]" value="{id}"></td>
      <td align="center" bgcolor="#FFFFFF"><script>document.write(ftime({ktime})); </script></td>
      <td align="center" bgcolor="#FFFFFF">{lx}</td>
      <td align="center" bgcolor="#FFFFFF">{cw}%&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF">{sp}&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF">{kcj}</td>
      <td align="center" bgcolor="#FFFFFF">{zsj}&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF">{zyj}&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF"><script>document.write(ftime({ptime})); </script></td>
      <td align="center" bgcolor="#FFFFFF">{pcj}&nbsp;</td>
	  <td align="center" bgcolor="#FFFFFF">{yld}&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF">{sn}</td>
      <td align="center" bgcolor="#FFFFFF"> {z}</td>
      <td align="center" bgcolor="#FFFFFF">{uname}</td>
      <td align="center" bgcolor="#FFFFFF">
	  <button  type="button" class="button button-mini button-success" onClick="openAppHd(\'{id}\',\'edit\')"><i class="x-icon x-icon-small icon-trash icon-white"></i>修改</button>

      <button type="button" class="button button-mini button-danger" onclick="if(confirm(\'确定删除？\'))location.href=\'?act=hd_del&ids[]={id}\'" ><i class="x-icon x-icon-small icon-trash icon-white"></i>删除</button></td>
    </tr>
')?>


  </table>
  </form> 
    <ul class="breadcrumb">
    <li class="active"><?=$pagenav?>
    </li>
  </ul>
</div>
<script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script> 
<script type="text/javascript" src="../assets/layer/layer.js"></script>
<script type="text/javascript" src="../assets/js/bui.js"></script> 
<script type="text/javascript" src="../assets/js/config.js"></script> 
<script type="text/javascript">
BUI.use('bui/overlay',function(Overlay){
            dialog = new Overlay.Dialog({
            title:'喊单修改',
            width:700,
            height:530,
            buttons:[],
            bodyContent:''
          });
		  
});
function openAppHd(id,type,choice_roomid){
	// dialog.set('bodyContent','<iframe src="app_hd_edit.php?id='+id+'&type='+type+'&choice_roomid='+choice_roomid+'" scrolling="yes" frameborder="0" height="100%" width="100%"></iframe>');
	// dialog.updateContent();
	// dialog.show();
  var title = '喊单修改';
  var index = layer.open({
    type: 2,
    title: title,
    area: ['580px', '490px'],
    content: 'app_hd_edit.php?id='+id+'&type='+type+'&choice_roomid='+choice_roomid
  });
}
BUI.use('bui/overlay',function(Overlay){
            dialog3 = new Overlay.Dialog({
            title:'喊单正确率',
            width:647,
            height:500,
            buttons:[],
            bodyContent:''
          });
});
function hd_trueinfo(){
	dialog3.set('bodyContent','<iframe src="app_hd_trueinfo.php?gid=<?=$sgid?>" scrolling="yes" frameborder="0" height="100%" width="100%"></iframe>');
	dialog3.updateContent();
	dialog3.show();
}
function choice_room(value){
    
    if(value=='0') return;
   window.location.href="?choice_roomid="+value; 
}
      </script>

</body>
</html>
