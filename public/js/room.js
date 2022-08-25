/*function createRequest(){			 
	var xmlhttp;
	if(window.XMLHttpRequest){
		 xmlhttp = new XMLHttpRequest();
	}else{
		 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}	  
	return xmlhttp;		 
}
//////////////////////////////////////////////////////////////////////////

function searchAction(){				
	if (this.readyState == 4 && this.status == 200) {	
        alert(this.responseText);			
		document.getElementById("room").innerHTML = this.responseText;		
  	   
	}							
}
//////////////////////////////////////////////////////////////////////////

function show_room(id){
	// alert(id);
	var xhhttp;
	xhhttp= createRequest();
	xhhttp.onreadystatechange = searchAction;
	xhhttp.open("GET","../roomType0/" + id , true); 
	xhhttp.send();
}*/

$(document).ready(function () {
    $('select[id="Section"]').on('change', function () {
     alert('ssss');
// ---------------------------------------------------------
var SectionId = $(this).val();
alert(SectionId);
var path ="{{ route('section') }}" +SectionId;
if (SectionId) {
	$.ajax({
	
		url: path,
		type: "GET",
		dataType: "json",
		// _token: '{{ csrf_token() }}',

		success: function(data) {
			$('select[id="product"]').empty();
			$.each(data, function(key, value) {
				$('select[id="product"]').append('<option value="' +
					value + '">' + value + '</option>');
			});
		},
	});

} else {
	console.log('AJAX load did not work');
}
// ---------------------------------------------------------

	});
});


// $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$4 
$('#modaldemo9').on('show.bs.modal', function(event) {
	// alert('bbbbbbbbbbbbbbb');
	var button = $(event.relatedTarget)

	var id = button.data('id')
	var room_type_name = button.data('room_type_name');
	var modal = $(this)
	modal.find('.modal-body #id').val(id);
			modal.find('.modal-body #room_type_name').val(room_type_name);

})