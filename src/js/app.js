/* setMainHeight(){
	var main_height= $(document).height()-($('header').outerHeight()+$('footer').outerHeight())-35;
	$('main').css({'height': '100%', 'min-height': main_height+'px'});
}
function setTextareaWidth(){
	$(".comment_form textarea").width(
		$('.comment_form input').innerWidth()-5
	);
}
		
		
setMainHeight();
setTextareaWidth();
		
$(window).resize(function(){
	setMainHeight();
	setTextareaWidth();
});*/

$(document).ready(function() {
    var users_list = $("#users_list");
    var table_balance = $("#table_balance");
    var monthes = new Map();
    monthes.set('1', "Январь");
    monthes.set('2', "Февраль");
    monthes.set('3', "Март");
    monthes.set('4', "Апрель");
    monthes.set('5', "Май");
    monthes.set('6', "Июнь");
    monthes.set('7', "Июль");
    monthes.set('8', "Август");
    monthes.set('9', "Сентябрь");
    monthes.set('10', "Октябрь");
    monthes.set('11', "Ноябрь");
    monthes.set('12', "Декабрь");

    $.ajax({
        method: 'GET',
        url: 'index/get_users_list',
        dataType: 'json',
        success:function(result){
            if(result.status==1){
                $.each(result.data, function(key, user){
                    users_list.
                    append("<option value='"+user.id+"'>"+user.name+"</option>");
                });
            }else{
                alert(result.message);
            }
        },
        error: function(msg){
            alert(msg);
        }
    });

    users_list.on("change", function (e){
        var that = $(this);
        table_balance.find('tbody').empty();
        if(that.val() !== ''){
            $.ajax({
                method: 'GET',
                url: 'transactions/get_user_balances',
                data: {'user_id':that.val()},
                dataType: 'json',
                success:function(result){

                    if(result.status==1){
                        let tbody = table_balance.find('tbody');
                        let data = result.data;
                        console.log(data);
                        if(data.length>0){

                            for(let i=0; i<data.length; i++){
                                $.each(data[i], function(key, balance){
                                    console.log(key);
                                    tbody.append(
                                        '<tr><td>' +monthes.get(key)+ '</td><td>'
                                        +balance+'</td></tr>'
                                    );
                                });
                            }

                        }else{
                            tbody.append('<tr><td colspan="2" class="text-center">Ничего не найдено</td></tr>');
                        }
                    }else{
                        alert(result.message);
                    }
                }
            });
        }

    });
	//добавление комментария
	/*$("#add_comment").on("submit", function(event){
		
		event.preventDefault();
		
		var that=$(this);
		var error_text=that.find('.text_error');
		var uname_val=that.find('#form_comment_uname').val();
		var comment_text=that.find('#form_comment_text').val();
		
		error_text.text('');
		error_text.hide();
		
		if(uname_val.length==0 || comment_text.length==0){
			error_text.text('Заполните все поля формы').show();
			return false;
		}
		
		var data={'uname':uname_val, 'comment':comment_text};
		
		$.ajax({
			method: that.attr('method'),
			url: that.attr('action'),
			data: data,
			dataType: 'json',
			success:function(result){
				if(result.status==1){
					alert('Комментарий добавлен');
					location.reload();
				}else{
					error_text.text(result.message);
				}
			},
			error: function(msg){
				alert(msg);
			}
		});
		
		console.log(data);
		
		
		
	});*/


	
});