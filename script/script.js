
// temperarory placement of the json files due to problems with fetch.
function loadNavMenu(){
    fetch('scp.json')
        .then(response => {console.log(response) 
            if(!response.ok){
            throw new Error(`HTTP error! Status:${response.status}`)
        }
        return response.json()})
        .then(data=>{console.log("SCP Data:", data);
            const navMenu= document.getElementById('navMenu');
            data.forEach(scp => {
                const link= document.createElement('a');
                link.href=`#${scp.description}`;
                link.textContent= scp.name;
                link.onclick = (event) =>{
                    event.preventDefault();
                    loadSCP(scp);
                };
                navMenu.appendChild(link);
        });
    })
    .catch(error => console.error("Error loading data:", error))
}

function loadSCP(scp){
    const display= document.getElementById('display');
    

    const content=`
        <h3>Object Name:${scp.name}</h3>
        <h4>Class:${scp.class}</h4>
        <p>Description:${scp.description}</p>
        <p>Containment:${scp.containment}</p>
        <img src=${scp.image} alt="${scp.name}">
        <button id="read" class="btn btn-primary">Read SCP Description</button>
        <br>
    `;
    display.innerHTML=content;
    document.getElementById('read').onclick=()=>{
        readdescription(scp.description);
    }
}

function readdescription(description){
    const speech = new SpeechSynthesisUtterance();
    speech.text= description;
    speech.voice =speechSynthesis.getVoices()[0];
    speechSynthesis.speak(speech);
    speech.lang="en-NZ";
}

window.onload= function(){
    loadNavMenu();
}