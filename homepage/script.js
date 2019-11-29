var template = $("#form_rows_tpl").html(),
    $target = $(".dynamic-rows"),
    $btnAdd = $("button.add"),
    $btnRemove = $("button.remove"),
    $msg = $('.msg'),
    max = 10, 
    count = 1,
    inputRow = [];

    $btnAdd.click(function(e){
      e.preventDefault();
      addRows();
    });

    $btnRemove.click(function(e){
      e.preventDefault();
      removeRows();
    });

function addRows(){
  if(count <= max){
    inputRow = {
      count : count
    }
    var html = Mustache.to_html(template, inputRow);
    $target.append(html);
    count++;
  }else{
    $msg.text('too many fields!');
  }
}

function removeRows(){
  $target.find('.row').last().remove();
  $msg.text('');
  if(count <= 1){
    count = 1;
  }else{
    count--;
  }
}

addRows();