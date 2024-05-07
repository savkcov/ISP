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

});