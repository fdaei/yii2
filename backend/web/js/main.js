function getVote($int) {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("poll").innerHTML=this.responseText;
        }
    }

    xmlhttp.open("GET","/index.php?r=site%2Fpoll&vote="+$int,true);
    xmlhttp.send();
}
function showResult(str) {
    if (str.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
    }
    xmlhttp.open("GET","/index.php?r=companies%2Fsuggestion&data="+str,true);
    xmlhttp.send();
}
$( function () {
    $(document).on('click','#btnajax', function(){
        var title=$('#titleNotes').val();
        var description=$('#descriptionNotes').val();
        $.ajax(
            {
                type:'POST',
                url : 'index.php?r=notes%2Fajax',
                data: {title : title,description:description},
                success : function (data){
                    alert(data);
                }
            }
        )
    });
    $(document).on('click','#btnjavascript', function(){
        var title=$('#titleNotes').val();
        var description=$('#descriptionNotes').val();
        $.post('index.php?r=notes%2Fajax',{'title':title,'description':description },function(data){
            alert(data);
        })
    });
    $(document).on('click','.language', function(){
        var lang  = $(this).attr('id');
        $.post('index.php?r=site%2Flanguage', {'lang':lang},function (data) {
            location.reload();
        });
    });
    $(document).on('click','.fc-day',function(){
        var date = $(this).attr('data-date');
        $.get('/index.php?r=events%2Fcreate',{'date':date},function(data){
            $('#modal').removeClass("fade")
                .modal('show')
                .find('#modalContent')
                .html(data);
        });
    });
    $('#modalButton').click( function () {
        $('#modal').removeClass("fade")
            .modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
    $(document).on('click','#suggtion', function(){
        var data = $("#globalSearch").val();
        $.get('/index.php?r=companies%2Fsuggestion',{'data':data});
    });
});
