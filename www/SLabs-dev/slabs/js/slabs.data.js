var path = "/www/Slabs-dev";

$(document).ready(function() {

    // //User Handling
    $("#toggleadduser").click(function(){
        $("#adduser").show();
        $("#removeuser").hide();
    });

    $("#toggleremoveuser").click(function(){
        $("#removeuser").show();
        $("#adduser").hide();

    });

    //Part Handling
    $("#toggleaddpart").click(function(){
        $("#addpart").show();
        $("#removepart").hide();
    });

    $("#toggleremovepart").click(function(){
        $("#removepart").show();
        $("#addpart").hide();

    });
});

//Load Stuff
function load_project(val){   
  clear_element_val("tests");
  $.ajax({
      type: 'post',
      url: path+'/pages/parts/data/ajax.php',
      data: {
           project_id:val
      },
      success: function (response) {
          $("#tests").html(response);
      }
  });
  reset_selector("carts","Select Test");
  retrieve_instrument($("#tool_search").val());
}

function load_test(val){   
    clear_element_val("carts");
    $.ajax({
        type: 'post',
        url: path+'/pages/parts/data/ajax.php',
        data: {
            test_id:val
        },
        success: function (response) {
            $("#carts").html(response);
        }
    });
    retrieve_instrument($("#tool_search").val());
}

function load_cart(val){
  update_current_cart();
  retrieve_instrument($("#tool_search").val());
}

//Cart Stuff 
function update_current_cart(){
  var cartID = $("#carts").val();
  if(cartID){
    $.ajax({
          type: 'post',
          url: path+'/pages/parts/data/ajax.php',
          data: {
              show_cart:cartID
          },
          success: function (response) {
              $("#current_cart").html(response);
          }
      });
  }
}

function add_instrument(id){
    var data = {
      cartID:$("#carts").val(),
      amount:$("#amount_"+id).val(),
      instrumentID:id
    };
    $.ajax({
        type: 'post',
        url: path+'/pages/parts/data/ajax.php',
        data: {
            add_instrument:data
        },
        success: function (response) {
        }
    });
   update_current_cart();
   retrieve_instrument($("#tool_search").val());
}

function remove_instrument(id){
  var data = {
      cartID:$("#carts").val(),
      instrumentID:id
    };
  $.ajax({
      type: 'post',
      url: path+'/pages/parts/data/ajax.php',
      data: {
        remove_instrument:data
      },
      success: function (response) {
      }
    });
  update_current_cart();
  retrieve_instrument($("#tool_search").val());
}

function finalize_current_cart(){
}

function get_cart(val){
  var data = {
      cartID:val
    };
  $.ajax({
      type: 'post',
      url: path+'/pages/parts/data/ajax.php',
      data: {
        display_cart_lab:data
      },
      success: function (response) {
        $("#cart").html(response);
      }
    });
}

//My Profile Stuff
function load_add_new(what){
	var data = {
		type:what,
		project:$("#projects").val(),
		test:$("#tests").val()
	};

	$.ajax({
		type:'post',
		url: path+'/pages/parts/data/ajax.php',
		data: {
			add_new_form:data
		},
		success: function(response){
			$("#add_to_workload").html(response);
		}
	});
}

function load_selected_project(){
  var data = {
    project:$("#projects").val(),
    test:$("#tests").val(),
    cart:$("#carts").val()
  };
  if(data['project']&&data['test']&&data['cart']){
    $.ajax({
      type:'post',
      url: path+'/pages/parts/data/ajax.php',
      data: {
        show_project:data
      },
      success: function(response){
        $("#selected_project").html(response);
      }
    });
  }else{
    $("#selected_project").html("Make sure you have selected a Project, Test, and Cart.");
  }
}

function check_project_name(n,t,id){
  var data = {
    name:n,
    type:t
  };
  $.ajax({
    type:'post',
    url: path+'/pages/parts/data/ajax.php',
    data: {
      checkNewData:data
    },
    success: function(response){
      if(response){
        $("#warning_"+id).text(response);
        $("#add_new").prop("disabled", true);
      }else{
        $("#warning_"+id).text("");
        if (isEmpty('#warning_projectName')&&isEmpty('#warning_testName')&&isEmpty('#warning_cartName')) {
          $("#add_new").prop("disabled", false);
        }
      }
    }
  });
}

//Search Instrument
function retrieve_instrument(name){
  clear_element("addition_warning");
  clear_element("tool_search_results");


  if($("#projects").val() && $("#tests").val() && $("#carts").val()){
    var data = {
      cartID:$("#carts").val(),
      search:name
    };
    $.ajax({
          type: 'post',
          url: path+'/pages/parts/data/search.php',
          data: {
              s:data
          },
          success: function (response) {
              $("#tool_search_results").html(response);
          }
      });
  }else{
    var html = "You need to select";

    if(!$("#projects").val()) html += " a Project, a Test, and a Cart.";
    else if(!$("#tests").val()) html += " a Test and a Cart.";
    else if(!$("#carts").val()) html += " a Cart.";

    $("#addition_warning").text(html);
    clear_element("current_cart");
  }
}

//Utils
function reset_selector(id,msg){
	clear_element(id);
	id = "#"+id;
	$(id).html("<option disabled selected>"+msg+"</option>");
}

function clear_element(id){
	id = "#"+id;
	$(id).html("");
  $(id).text("");
  $(id).val("");
}

function clear_element_val(id){
  id = "#"+id;
  $(id).val("");
}

function isEmpty(el){
  if($(el).text()<1){
    return true;
  }return false;
}
