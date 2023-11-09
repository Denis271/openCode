const elementForm = document.getElementById('Form')

function cancelBlock(id){
    document.getElementById(id).style.display = "none"
}
function openBlock(id){
    document.getElementById(id).style.display = "block"
}

function checkStateNumber(){ //проверка номера 
    let stateNumber = elementForm.stateNumber.value.toUpperCase().replace(/\s/g, '')
    let re = /^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui
    var valid = re.test(stateNumber)
    console.log(valid)
    if (valid){
        elementForm.submit.removeAttribute("disabled");
        cancelBlock('errorStateNumber')
    }else{
        elementForm.submit.setAttribute("disabled", "disabled")
        openBlock('errorStateNumber')
    }
}

function checkYear(){ //проверка года
    let year = elementForm.year.value
    if (year.length == 4 && year < 2024 && year > 1950){
        elementForm.submit.removeAttribute("disabled")
        cancelBlock('errorYear')
    }else{
        elementForm.submit.setAttribute("disabled", "disabled")
        openBlock('errorYear')
    }
}

function checkChassisNumber(){ //проверка номера шасси
    let chassisNumber = elementForm.chassisNumber.value
    if (chassisNumber.length == 17){
        elementForm.submit.removeAttribute("disabled")
        cancelBlock('errorChassisNumber')
    }else{
        elementForm.submit.setAttribute("disabled", "disabled")
        openBlock('errorChassisNumber')
    }
}

function checkBodyNumber(){ //проверка номера кузова
    let bodyNumber = elementForm.bodyNumber.value
    if (bodyNumber.length > 8 && bodyNumber.length < 18){
        elementForm.submit.removeAttribute("disabled")
        cancelBlock('errorBodyNumberr')
    }else{
        elementForm.submit.setAttribute("disabled", "disabled")
        openBlock('errorBodyNumberr')
    }
}

function checkСategories(){ //проверка категории
    let category = elementForm.category.value.toUpperCase()
    const arrCategories = ["A","A1","B","B1","C","C1","D","D1","BE","CE","C1E","DE","D1E","M","TM","TB"];
    let categoryArr = [category]
    if(arrCategories.indexOf(categoryArr[0]) == -1){
        category = false
    }else{
        category = true
    } 
    if(category == false){
        openBlock('errorCategories')
        elementForm.submit.setAttribute("disabled", "disabled")
    }else{
        cancelBlock('errorCategories')
        elementForm.submit.removeAttribute("disabled")
    }
}

function validateForm() {
    let stateNumber = elementForm.stateNumber.value
    let year = elementForm.year.value
    let chassisNumber = elementForm.chassisNumber.value
    let bodyNumber = elementForm.bodyNumber.value
    let category = elementForm.category.value
    if ((stateNumber == null || stateNumber == "") || (year === "" || year == null) ||  (chassisNumber == null || chassisNumber == "") || (bodyNumber == null || bodyNumber == "") || (category == null || category == "")) {
      return false
    }else{return true}
  }

function ajaxGet(){
    let stateNumber = elementForm.stateNumber.value.toUpperCase().replace(/\s/g, '')
    let year = elementForm.year.value
    let chassisNumber = elementForm.chassisNumber.value.toUpperCase()
    let bodyNumber = elementForm.bodyNumber.value.toUpperCase().replace(/\s/g, '')
    let category = elementForm.category.value.toUpperCase().replace(/\s/g, '')
    let idCar = elementForm.idCar.value
    let idDriver = elementForm.driver.value
    console.log('data.php?stateNumber=' + stateNumber + '&year=' + year + '&chassisNumber=' + chassisNumber + '&bodyNumber=' + bodyNumber + '&category=' + category + '&idCar=' + idCar+ '&idDriver=' + idDriver + '&update=1')
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
           if(request.responseText == 0){
                document.location.href = "";
           }else{
                openBlock('errorStateNumberDB')
           }     
        }
    }
    let urlAjaX = 'data.php?stateNumber=' + stateNumber + '&year=' + year + '&chassisNumber=' + chassisNumber + '&bodyNumber=' + bodyNumber + '&category=' + category + '&idCar=' + idCar+ '&idDriver=' + idDriver + '&update=1'
    request.open('GET',urlAjaX)
    request.send();
}

function handleButform(event){
    event.preventDefault()
    cancelBlock('errorInput')
    event.preventDefault()
    if(validateForm()){
        ajaxGet()
    }else{
        openBlock('errorInput')
    } 
}

elementForm.addEventListener('submit', handleButform)



function deleteCarDB(idCar,idDriver){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
           if(request.responseText == 0){
                document.location.href = "../index.php";
           }else{
                alert('Ошибка')
           }     
        }
    }
    let urlAjaX = 'data.php?idCar=' + idCar + '&idDriver=' + idDriver +'&deleteCarDB=1' 
    request.open('GET',urlAjaX)
    request.send();
}