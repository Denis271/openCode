let errorLogin = false
    function ajaxGet(login,password){
        let request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let data = JSON.parse(request.responseText)
                if(data.chackUser == 0){
                    document.getElementById("errorForm").style.display = "block";
                    errorLogin = true
                }
                if(data.chackUser == 1){
                    document.location.href = "../../index.php"; 
                }
            }
            
        }
        let urlAjaX = 'data.php?login=' + login + '&password=' + password 
        request.open('GET',urlAjaX)
        request.send();
    }
    
    



const elementForm = document.getElementById('Form')

function handleButform(event){
    if(errorLogin == true){
        document.getElementById("errorForm").style.display = "none";
        errorLogin = false
    }
    event.preventDefault();
    let login = elementForm.login.value;
    let password = elementForm.password.value;

    ajaxGet(login,password)
    
}
elementForm.addEventListener('submit', handleButform)
