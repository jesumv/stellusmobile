function revisaact(fechaevent,iddoctorevent,idhospevent){
		return $.ajax({
			 url:"php/get_event.php",
		        data: {
		        	fechaevent:fechaevent,
		        	iddoctorevent:iddoctorevent,
		        	idhospevent:idhospevent
		        },
		        type: 'POST',
		        dataType: 'json'
		});
				}