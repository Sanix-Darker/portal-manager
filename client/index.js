let TOKEN ="2nSftf0JYKAQ52qz6RLRfoWmPqiSPmnRFI4C3fOiMZ7RKE5LVOcv1Eb7QWLOqQikrh2cZX_zZgQJxKgbIDHGjY4Ko4LDex1vqyNu";
let API = document.location.href.replace("/client/", "").replace(":8080", "")+":80/php/portal/api/?page=badging&token="+TOKEN;
// 1. Create a new XMLHttpRequest object
let xhr = new XMLHttpRequest();

setInterval(function(){
    console.log(API);
    // 2. Configure it: GET-request for the URL /article/.../load
    xhr.open('GET', API);

    // 3. Send the request over the network
    xhr.send(null);

    // 4. This will be called after the response is received
    xhr.onload = function() {
        if (xhr.status != 200) { // analyze HTTP status of the response
            alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
        } else { // show the result
            console.log(`Done, got ${xhr.response.length} bytes`); // responseText is the server
            console.log(xhr.responseText);
            var results = JSON.parse(xhr.responseText)["result"];
            var to_render = "<ul>";
            results.forEach(element => {
                to_render += "<li> <div> > MATRICULE:<b>"+element["MATRICULE"]+"</b> <br> > INFO:<b>"+element["INFO"]+"</b> <br>  > STATUS:<b>"+element["STATUS"]+"</b> </div></li>";
            });
            to_render += "<ul>";
            document.getElementById("result").innerHTML = to_render;
        }
    };

    xhr.onprogress = function(event) {
        if (event.lengthComputable) {
            console.log(`Received ${event.loaded} of ${event.total} bytes`);
        } else {
            console.log(`Received ${event.loaded} bytes`); // no Content-Length
        }
    };

    xhr.onerror = function() {
        alert("Request failed");
    };
}, 2000)
