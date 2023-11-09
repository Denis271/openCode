const elementForm = document.getElementById('Form')
function cancelBlock(id){
    document.getElementById(id).style.display = "none"
}
function openBlock(id){
    document.getElementById(id).style.display = "block"
}



function checkTel(){ //проверка телефона
    let re = /^\+?(\d{1,3})?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/;
    let tel = elementForm.tel.value
    var valid = re.test(tel)
    if (valid){
        elementForm.submit.removeAttribute("disabled");
        cancelBlock('errorTel')
        return true
    }else{
        elementForm.submit.setAttribute("disabled", "disabled")
        openBlock('errorTel')
    }
}
function checkIdNumber(){ //проверка номера прав
    let idNumber = elementForm.idNumber.value
    if (idNumber.length == 10){
        elementForm.submit.removeAttribute("disabled")
        cancelBlock('errorIdNumber')
        return true
    }else{
        elementForm.submit.setAttribute("disabled", "disabled")
        openBlock('errorIdNumber')
    }
}
function checkСategories(){ //проверка категорий
    let categories = elementForm.categories.value.toUpperCase().replace(/\s/g, '');
    let arrCategories = ["A","A1","B","B1","C","C1","D","D1","BE","CE","C1E","DE","D1E","M","TM","TB"];
    const categoriesArr = categories.split(',')
    for(var i=0; i<categoriesArr.length; i++){
        if(arrCategories.indexOf(categoriesArr[i]) == -1){
            elementForm.submit.setAttribute("disabled", "disabled")
            openBlock('errorCategories')
            return false
        } 
    }
    elementForm.submit.removeAttribute("disabled")
    cancelBlock('errorCategories')
    return true
}


function validateForm() {
    let fio = elementForm.fio.value
    let dateBirth = elementForm.dateBirth.value
    let tel = elementForm.tel.value
    let idNumber = elementForm.idNumber.value
    let dateIssue = elementForm.dateIssue.value
    let categories = elementForm.categories.value
    if ((fio == null || fio == "") || (dateBirth === "") || (tel == null || tel == "") || (idNumber == null || idNumber == "") || (!Date.parse(dateIssue)) || (categories == null || categories == "")) {
      return false
    }else{return true}
  }

function ajaxGet(){
    let fio = elementForm.fio.value
    let dateBirth = elementForm.dateBirth.value
    let tel = elementForm.tel.value
    let idNumber = elementForm.idNumber.value
    let dateIssue = elementForm.dateIssue.value
    let categories = elementForm.categories.value.toUpperCase().replace(/\s/g, '').replace(/,/g, '-')
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
           if(request.responseText == 0){
                document.location.href = "../index.php";
           }else{
                openBlock('errorIdNumberDB')
           }     
        }
    }
    let urlAjaX = 'data.php?fio=' + fio + '&dateBirth=' + dateBirth + '&tel=' + tel + '&idNumber=' + idNumber + '&dateIssue=' + dateIssue + '&categories=' + categories
    request.open('GET',urlAjaX)
    request.send();
}

function handleButform(event){
    cancelBlock('errorIdNumber')
    cancelBlock('errorInput')
    event.preventDefault()
    if(validateForm()){
        ajaxGet()
    }else{
        openBlock('errorInput')
    } 
}

elementForm.addEventListener('submit', handleButform)




