   $.fn.formgroup = function () {
            var obj = $(this);
            var oprationObj = init(obj);
            
            function init(obj){
                
                var input = '<div class="pop_div form-control input_tag bootstrap-tagsinput" data-target="#pop_div"></div>';
                var inputobject = $(input);
                  input += '<div class="col-md-12" id="pop_div" style="display: none;">';
                var option = '<div class="opt_options">';
                var optionHtml = '<ul class="group_header">';
                var selectdoption = '';
            
 console.log($(".group").val());
                $(obj).find("optgroup").each(function (index, value) {
                    var label = $(this).attr("label");
                    var group_id = $(this).attr("id");
                    optionHtml += '<li data-target="#gp' + index + '" class="opt_group"><i class="fa fa-users"></i> ' + label + ' <i class="fa fa-caret-right pull-right"></i> </li>';

                    option += '<ul style="display: none;" id="gp' + index + '" class="opt"><li class="back_btn"><i class="fa fa-caret-left"></i> Back</li>';

                   
                     
                    var  field_name = $(".group").attr('data-name');
                    $(this).find("option").each(function (opt_key, opt_val) {
                         
                         if($(this).is(':selected')){
                         var text = $(this).text();
                         var val = $(this).val();
                         
                         option += '<li class="select_option disabled" disabled="true" data-search ="'+group_id+'" data-val="' + $(this).val() + '"><i class="fa fa-users"></i> ' + $(this).text() + ' </li>';
                         selectdoption = '<span class="tag label label-info" id=tag_'+group_id+'>'+text+'<span class="remove_tag" data-role="remove" data-id ='+val+'></span><input style="display:none"  type="text" name="'+field_name+'" value='+val+'></span>';               
            }
                         else{
                       
                            option += '<li class="select_option" data-search ="'+group_id+'" data-val="' + $(this).val() + '"><i class="fa fa-users"></i> ' + $(this).text() + ' </li>';
                             }
                         });
                   
                  
                   
option += "</ul>";
                })

                optionHtml += '</ul>';
                option += '</div>';
                var footer = '</div>';

                var final = input + optionHtml + option + footer;


                var oprationObj = $(final);
                
                $(obj).hide();
                $(obj).parent().append(oprationObj);
                    
//                 $('.input_tag').html("");
                 console.log(selectdoption);
                 $('.input_tag').html(selectdoption);
                  
                return oprationObj;
            }
            
             $('body').on('click', '.pop_div', function () {
              
                var target = $(this).attr('data-target');
                var mainobj = $(this).parent().find(target);
                if ($(mainobj).is(":visible")) {
                    $(mainobj).slideUp("normal");
                }
                else {
                    $(mainobj).slideDown("normal");
                }
            }); 
             
            
            
            $('body').on('click','.select_option',function(){
                  if($(this).hasClass("disabled")==false){
                  $(this).prop('disabled', 'disabled');
                  $(this).addClass('disabled');
                  var group_id = $(this).attr('data-search');
                  var  name = $(".group").attr('data-name');
                  var text = $(this).text().trim();
                  var val = $(this).attr('data-val');
                  var html = '<span class="tag label label-info">'+text+'<span class="remove_tag" data-role="remove" data-id ='+val+'></span><input style="display:none"  type="text" name="'+name+'" value='+val+'_'+group_id+'></span>';                 
                $('.input_tag').html(html);
                 $('.opt_options').find('ul').find("li").prop('disabled', false).removeClass('disabled');
                $('.opt_options').find('ul').find("li[data-val = '"+val+"']").prop('disabled', true).addClass('disabled'); 
                  }
             });
                          
             $('.pop_div').on('click','.remove_tag',function(){
              $(this).parent().remove();
              var val = $(this).attr('data-id');
              $('.opt_options').find('ul').find("li[data-val = '"+val+"']").prop('disabled', false).removeClass('disabled');
             });
            
//            $('body').on('keyup','.pop_div',function(){
//               var search = $(this).val();
//               console.log(search);
//               console.log( $('.opt_options').find('ul').find("li[data-search *= '"+search+"']").text());
////              console.log( $(this).next( "div:contains('John')"));
//          
//            });

            $('body').on('click', '.opt_group', function () {
                var obj = $(this);
                console.log($(obj).find('.opt').length);
                $(obj).find('.opt').addClass('animated slideInRight').toggle();

            });

            $('body').on('click', '.opt_group', function () {
                $(this).parent().hide();
                var target = $(this).attr('data-target');
                if ($(target).is(":visible")) {
                    $(target).addClass('animated slideInLeft').toggle();
                }
                else {
                    $(target).addClass('animated slideInRight').toggle();
                }
            });

            $('body').on('click', '.back_btn', function () {
                $('.group_header').addClass('animated slideInLeft').fadeIn();
                $(this).parent('ul').hide();

            });

        };