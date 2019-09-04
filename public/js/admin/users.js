document.body.onload=()=>{
   console.log('Loaded!');
    let showformBtn=document.getElementById('show-new-user-form');

    let newuserForm=document.getElementById('new-user-form');
    newuserForm.style.display='none';

    showformBtn.onclick=()=>{
        if(newuserForm.style.display=="none"){
            newuserForm.style.display="block"
        }else{
            newuserForm.style.display="none"
        }
    }
}