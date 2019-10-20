let TOKEN ="2nSftf0JYKAQ52qz6RLRfoWmPqiSPmnRFI4C3fOiMZ7RKE5LVOcv1Eb7QWLOqQikrh2cZX_zZgQJxKgbIDHGjY4Ko4LDex1vqyNu";
let API = document.location.href.replace("/client/", "").replace(":8080", "")+"/php/portal/api/?page=[p]&token="+TOKEN;

function badging_template(results){
    let to_render = "";
    let counter = 1;
    results.forEach(element => {
        to_render += "<tr>";
        to_render += "<th scope='row'>"+counter+"</th>";
        to_render += "<td>"+element["BADGING_ID"]+"</th>";
        to_render += "<td>"+element["MATRICULE"]+"</th>";
        to_render += "<td>"+element["INFO"]+"</td>";
        to_render += "<td style='color:white;font-weight: bold;background:"+((element["STATUS"] == 'OK')?"blue":"grey")+"'>"+element["STATUS"]+"</td>";
        to_render += "<td>"+element["DATE_"]+"</td>";
        to_render += "<tr>";
        counter += 1;
    });
    return to_render;
}

function command_template(results){

    let to_render = "";
    let counter = 1;
    results.forEach(element => {
        to_render += "<tr>";
        to_render += "<th scope='row'>"+counter+"</th>";
        to_render += "<td>"+element["COMMAND_ID"]+"</th>";
        to_render += "<td>"+element["ADDRESS"]+"</th>";
        to_render += "<td>"+element["TODO"]+"</td>";
        to_render += "<td style='color:white;font-weight: bold;background:"+((element["STATUS"] == 'OK')?"green":"red")+"'>"+element["STATUS"]+"</td>";
        to_render += "<td>"+element["DATE_"]+"</td>";
        to_render += "<tr>";
        counter += 1;
    });
    return to_render;
}

// 1. Create a new XMLHttpRequest object
let xhr = new XMLHttpRequest();
let xhr1 = new XMLHttpRequest();
function fetchIT(type, target){

    let API_to_fetch = API.replace("[p]", type);
    console.log("type: ", type)
    console.log("API_to_fetch: ", API_to_fetch)

    if (type == 'badging'){

        // 2. Configure it: GET-request for the URL /article/.../load
        xhr.open('GET', API_to_fetch);
        // 3. Send the request over the network
        xhr.send(null);
        // 4. This will be called after the response is received
        xhr.onload = function() {
            if (xhr.status != 200) { // analyze HTTP status of the response
                alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
            } else { // show the result
                    document.getElementById(target).innerHTML = badging_template(JSON.parse(xhr.responseText)["result"]);
            }
        };

    }else if (type == 'command'){

        // 2. Configure it: GET-request for the URL /article/.../load
        xhr1.open('GET', API_to_fetch+"&type=all");
        // 3. Send the request over the network
        xhr1.send(null);
        // 4. This will be called after the response is received
        xhr1.onload = function() {
            if (xhr1.status != 200) { // analyze HTTP status of the response
                alert(`Error ${xhr1.status}: ${xhr1.statusText}`); // e.g. 404: Not Found
            } else { // show the result
                document.getElementById(target).innerHTML = command_template(JSON.parse(xhr1.responseText)["result"]);
            }
        };

    }
}

setInterval(function(){

    if(document.getElementById("badging_refresh").value == "activated"){
        setTimeout(function(){
            fetchIT('badging', 'result');
        }, 2000)
    }

    if(document.getElementById("command_refresh").value == "activated"){
        setTimeout(function(){
            fetchIT('command', 'result_command');
        }, 2000)
    }

}, 1000)
