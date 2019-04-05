window.addEventListener("load", function(){

	load_list();
},false);

function load_list(){
                var request = new XMLHttpRequest();
                var  the_data = 'load_list=1';
                request.open("POST", "http:\/\/104.155.234.246/project/load_list.php", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(the_data);
                var link_list="";
                request.onreadystatechange = function() {
                        if (request.readyState == 4) {
                                var response=JSON.parse(request.responseText.trim());
                                //var response = response.files;
                                response.forEach(function myFunction(value){
                        //      if(link_list)   
                                link_list = link_list+"<a onclick='download_link(this)'>"+value+"</a>";
                                });
                        document.getElementById('list').innerHTML=link_list;
                        //document.getElementById('theArea').contentDocument.body.innerHTML = response.load_data;
                        //document.getElementById('file_name').innerHTML=response.current_file;
                        //var sharer = response.load_data.trim();
                                //document.write("above data sync call")
                        //      init_datasync(sharer);
                        }
                };
        }

function download_link(link){

var request = new XMLHttpRequest();
var  the_data = 'down_link='+link.innerHTML;
request.open("POST", "http:\/\/104.155.234.246/project/download_link.php",true);
request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.send(the_data);
var link_list="";
request.onreadystatechange = function() {
      if (request.readyState == 4) {
		if(request.responseText.trim()=="done")
		window.location = 'http:\/\/104.155.234.246/project/uploads/'+link.innerHTML;
	}
    };

}
