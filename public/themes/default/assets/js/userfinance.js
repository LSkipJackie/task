/**
 * Created by kuke on 2016/5/6.
 */

$('.input-daterange').datepicker({autoclose:true});


var financeExport = function(){
    var start = $("input[name = 'start']").val();
    var end = $("input[name = 'end']").val();
    var param = 'start=' + start + '&end=' + end;
    var url = document.domain + '/manage/financeListExport/' + param;
    window.open('http://' + url);
}

var userFinanceExport = function(){
    var start = $("input[name = 'start']").val();
    var end = $("input[name = 'end']").val();
    var uid = $("input[name = 'uid']").val();
    var username = $("input[name = 'username']").val();
    var order = $("#order").val();
    var by = $("#by").val();
    var action = $("#action").val();
    var param = 'start=' + start + '&end=' + end + '&uid=' + uid + '&username=' + username + '&order=' + order + '&by=' + by + '&action=' + action;
    var url = document.domain + '/manage/userFinanceListExport/' + param;
    window.open('http://' + url);
}

