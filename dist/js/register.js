"use strict";$(document).ready(function(){$("#yzmP").html(createCode()).css({fontSize:"24px",fontWeight:"bolder",textAlign:"center",lineHeight:"40px"}),$("#yzmPic").on("click",function(){$("#yzmP").html(createCode())});var e=void 0;$(".tip1").eq(0).on("input",function(){oName_state=!1,e=$(".tip1").eq(0).val(),oNa(e),oName_state&&$.ajax({type:"POST",url:"../api/3.register&login.php?",data:{type:"register",username:e}}).done(function(e){(e=JSON.parse(e)).result?$(".username").html(e.message).css("color","green"):($(".username").html(e.message).css("color","red"),oName_state=!1)}).fail(function(){console.log("error")}).always(function(){console.log("complete")})});var t=void 0;$(".tip1").eq(1).on("input",function(){psw_state=!1,t=$(".tip1").eq(1).val(),pSw(t),psw_state&&$.ajax({type:"POST",url:"../api/3.register&login.php?",data:{type:"register",psw:t}}).done(function(e){(e=JSON.parse(e)).result&&$(".psw1").html(e.message).css("color","green")}).fail(function(){console.log("error")}).always(function(){console.log("complete")})}),$(".tip1").eq(2).on("input",function(){psw_state2=!1,$(".tip1").eq(2).val()===$(".tip1").eq(1).val()&&(psw_state2=!0)}),$(".tip1").eq(3).on("input",function(){yzm_state=!1,$("#yzmP").html().toLowerCase()===$(".tip1").eq(3).val().toLowerCase()&&(yzm_state=!0)}),$(".subBtn").click(function(){oName_state&&psw_state&&psw_state2&&yzm_state?$.ajax({type:"POST",url:"../api/3.register&login.php?",data:{type:"register",reg:!0,psw:t,username:e}}).done(function(e){JSON.parse(e).result&&(location.href="login.html")}).fail(function(){console.log("error")}).always(function(){console.log("complete")}):alert("注册信息有误")})}),window.onload=function(){var e=document.querySelector("#reg"),n=document.querySelectorAll(".tip1");e.onclick=function(e){if("tip1"==(e=window.event||e).target.className){for(var t=0;t<n.length;t++)n[t].nextElementSibling.nextElementSibling.style.display="none";e.target.nextElementSibling.nextElementSibling.style.display="block"}}};